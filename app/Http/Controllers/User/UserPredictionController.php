<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PredictionCreateRequest;
use App\Models\Predictionresult;
use App\Models\Student;
use Phpml\Classification\NaiveBayes;
use Phpml\Metric\Accuracy;
use Phpml\Metric\ConfusionMatrix;

class UserPredictionController extends Controller
{
    public function index()
    {
        $predictions = Predictionresult::with('user')->where('user_id', auth()->user()->id)->get();;
        return view('user.prediction.show', compact('predictions'));
    }
    public function create()
    {
        return view("user.prediction.create");
    }

    public function store(PredictionCreateRequest $request)
    {
                // Ambil hanya kolom yang diperlukan dari database
        $students = Student::select([
            'nama',
            'npm',
            'ips1',
            'ips2',
            'ips3',
            'ips4',
            'ips5',
            'status'
            ])->get();


        //kode baru menganalisis korelasi antara kolom ips 1 sampai 5 dan kolom status

         // Buat larik untuk nilai IPS dan status
        $ips = [];
        $status = [];

        foreach ($students as $student) {
            $ips[] = [
                (float) $student->ips1,
                (float) $student->ips2,
                (float) $student->ips3,
                (float) $student->ips4,
                (float) $student->ips5,
            ];
            

            $status[] = (int) $student->status;
        }

        // Calculate theoretical quantiles
        $theoreticalQuantiles = [];
        for ($i = 0; $i < count($ips[0]); $i++) {
            $theoreticalQuantiles["ips" . ($i + 1)] = $this->calculateTheoreticalQuantiles($ips, $i);
        }
        // Calculate theoretical quantiles

        // Hitung koefisien korelasi Pearson antara "status" dan setiap kolom nilai IPS
        $correlations = [];

        for ($i = 0; $i < count($ips[0]); $i++) {
            $correlation = $this->pearsonCorrelation($status, array_column($ips, $i));
            $correlations["ips" . ($i + 1)] = $correlation;
        }
        //kode baru

        // Acak (shuffle) data sebelum membaginya
        $students = $students->shuffle();
        // Hitung jumlah data yang akan diambil untuk pelatihan dan validasi
        $totalData = $students->count();
        $trainDataCount = (int) ($totalData * 0.8); // 80% data untuk pelatihan
        $testDataCount = $totalData - $trainDataCount; // Sisa data untuk validasi

        // Bagi data menjadi data pelatihan dan data validasi
        $trainData = $students->take($trainDataCount);
        $testData = $students->take($testDataCount);



        //persiapan data latih
        $trainDataFeatures = $trainData->map(function ($student) {
            return [
                // $student->nama,
                // $student->npm,
                $student->ips1,
                $student->ips2,
                $student->ips3,
                $student->ips4,
                $student->ips5,
            ];
        });

        $trainDataLabels = $trainData->map(function ($student) {
            return $student->status;
        });

        //ubah objek koleksi menjadi array
        $trainDataFeatures = $trainDataFeatures->toArray();
        $trainDataLabels = $trainDataLabels->toArray();
        
        //membuat data latih model naive bayes
        $classifier = new NaiveBayes();
        $classifier->train($trainDataFeatures, $trainDataLabels);

        // Prediksi hubungan (misalnya, dengan data baru dari form)
        $newData = [
            // htmlspecialchars($request->nama),
            // htmlspecialchars($request->npm),
            htmlspecialchars($request->ips1),
            htmlspecialchars($request->ips2),
            htmlspecialchars($request->ips3),
            htmlspecialchars($request->ips4),
            htmlspecialchars($request->ips5),
        ];

        // Lakukan prediksi
        $predictedLabel = $classifier->predict([$newData]);

        // Sekarang, $predictedLabel berisi prediksi apakah hubungan adalah positif atau negatif

            // Hitung IPK
        $ips1 = (float)$request->ips1;
        $ips2 = (float)$request->ips2;
        $ips3 = (float)$request->ips3;
        $ips4 = (float)$request->ips4;
        $ips5 = (float)$request->ips5;

        // Jumlahkan nilai IPS1 hingga IPS5
        $totalIPS = $ips1 + $ips2 + $ips3 + $ips4 + $ips5;

        // Hitung rata-rata IPK
        $jumlahSemester = 5; // Jumlah ip semester (IPS1 hingga IPS5)
        $ipk = $totalIPS / $jumlahSemester;
        
        $statusLulus = ($predictedLabel[0] === 1);

        

        $existingPrediction = Predictionresult::where('user_id', auth()->user()->id)
        ->where('npm', $request->npm)
        ->first();

        if ($existingPrediction) {
            // Data sudah ada, kirim pesan ke pengguna
            return back()->with('toast_error', 'Data npm Sudah Ada sebelumnya');
        } else {
            // Data belum ada, simpan prediksi
            $predictionResult = new Predictionresult();
            $predictionResult->user_id = auth()->user()->id;
            $predictionResult->nama = $request->nama;
            $predictionResult->npm = $request->npm;
            $predictionResult->ips1 = $request->ips1;
            $predictionResult->ips2 = $request->ips2;
            $predictionResult->ips3 = $request->ips3;
            $predictionResult->ips4 = $request->ips4;
            $predictionResult->ips5 = $request->ips5;
            $predictionResult->status_kelulusan = $statusLulus;
            $predictionResult->ipk = $ipk;
            $predictionResult->save();
        }
        
        // ambil data nama dan NPM dari input form
        $nama = $request->nama;
        $npm = $request->npm;

            //menghitung matrik evaluasi 
            $testDataFeatures = $testData->map(function ($student) {
                return [
                    htmlspecialchars($student->ips1),
                    htmlspecialchars($student->ips2),
                    htmlspecialchars($student->ips3),
                    htmlspecialchars($student->ips4),
                    htmlspecialchars($student->ips5),
                ];
            });

            $testDataLabels = $testData->map(function ($student) {
                return $student->status;
            

            });
            //mengonversi objek koleksi tersebut menjadi array 
            $testDataFeatures = $testDataFeatures->toArray();
            $testDataLabels = $testDataLabels->toArray();


            
            // Lakukan prediksi
            $predictedTestLabels = $classifier->predict($testDataFeatures);
            // Hitung metrik evaluasi
            $accuracy = Accuracy::score($testDataLabels, $predictedTestLabels);
            $confusionMatrix = ConfusionMatrix::compute($testDataLabels, $predictedTestLabels);

            // Pastikan array untuk indeks 0 ada sebelum mengaksesnya
            $truePositives = isset($confusionMatrix[1][1]) ? $confusionMatrix[1][1] : 0; // True Positives
            $falsePositives = isset($confusionMatrix[0][1]) ? $confusionMatrix[0][1] : 0; // False Positives
            $falseNegatives = isset($confusionMatrix[1][0]) ? $confusionMatrix[1][0] : 0; // False Negatives
            $trueNegative = isset($confusionMatrix[0][0]) ? $confusionMatrix[0][0] : 0; // True Negative
        
            // $truePositives = $confusionMatrix[1][1]; // True Positives
            // $falsePositives = $confusionMatrix[0][1]; // False Positives
            // $falseNegatives = $confusionMatrix[1][0]; // False Negatives
            // $trueNegative = $confusionMatrix[0][0]; // True Negative
        
            $precision = $truePositives / ($truePositives + $falsePositives);
            $recall = $truePositives / ($truePositives + $falseNegatives);



            // Hitung F1-score
            $f1Score = (2 * $precision * $recall) / ($precision + $recall);
        
            //Tampilkan hasil prediksi dan metrik evaluasi ke view
            return view('user.prediction.result', compact(
                'predictedLabel',
                'accuracy',
                'confusionMatrix',
                'precision',
                'recall',
                'f1Score',
                'truePositives',
                'falsePositives',
                'falseNegatives',
                'trueNegative',
                'nama',
                'npm',
                'ipk',
                'correlations',
                'theoreticalQuantiles',
            ));


    }

    private function pearsonCorrelation($x, $y)
    {
        $n = count($x);

        $meanX = array_sum($x) / $n;
        $meanY = array_sum($y) / $n;
        
        $covariance = 0;
        $varianceX = 0;
        $varianceY = 0;

        for ($i = 0; $i < $n; $i++) { 
            $covariance += ($x[$i] - $meanX) * ($y[$i] - $meanY);
            $varianceX += pow($x[$i] - $meanX, 2);
            $varianceY += pow($y[$i] - $meanY, 2);
        }
        $correlation = $covariance / (sqrt($varianceX) * sqrt($varianceY));
        return $correlation;
    }

    private function calculateTheoreticalQuantiles($data, $columnIndex)
    {
            // Sort the data
        $sortedData = $data;
        sort($sortedData);

        // Calculate quantiles for a normal distribution
        $n = count($sortedData);
        $theoreticalQuantiles = [];
        $mean = array_sum($sortedData) / $n; // Rerata
        $stddev = 0;

        foreach ($sortedData as $subarray) {
            foreach ($subarray as $x) {
                $stddev += pow($x - $mean, 2);
            }
        }

        $stddev = sqrt($stddev / $n); // Deviasi standar

        for ($i = 1; $i <= $n; $i++) {
            $p = ($i - 0.5) / $n;
            $z = sqrt(-2.0 * log(1.0 - $p));
            $quantile = $mean + $stddev * $z;
            $theoreticalQuantiles[] = $quantile;
        }

        return $theoreticalQuantiles;
    }

    public function destroy($id)
    {
        $user_id = auth()->user()->id;
        Predictionresult::where('user_id', $user_id)
            ->where('id', $id)
            ->delete();
        return redirect()->back()->with('toast_success', 'Hasil prediksi berhasil dihapus.');

    }
    
}
