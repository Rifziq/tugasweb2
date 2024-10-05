<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskon Belanja</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <div class="container">
        
        <h2>Diskon Belanja</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="totalBelanja">Total Belanja (Rp):</label>
                <input type="number" id="totalBelanja" name="totalBelanja" required>
            </div>

            <div class="form-group">
                <label for="Member">Status Member:</label>
                <select id="Member" name="Member" required>
                    <option value="1">Member</option>
                    <option value="0">Non-member</option>
                </select>
            </div>

            <button type="submit" name="submit">Hitung Total Bayar</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            
            function hitungTotalBelanja($totalBelanja, $Member)
            {
                $diskon = 0;
                $diskonKeterangan = '';

                if ($Member) {
            
                    $diskon = 0.10;
                    $diskonKeterangan = "Diskon member 10%";

            
                    if ($totalBelanja > 1000000) {
                        $diskon += 0.15;
                        $diskonKeterangan .= " + Tambahan diskon 15% (belanja > Rp 1.000.000)";
                    } elseif ($totalBelanja >= 500000) {
            
                        $diskon += 0.10;
                        $diskonKeterangan .= " + Tambahan diskon 10% (belanja antara Rp 500.000 dan Rp 1.000.000)";
                    }
                } else {
            
                    if ($totalBelanja > 1000000) {
                        $diskon = 0.10;
                        $diskonKeterangan = "Diskon non-member 10% (belanja > Rp 1.000.000)";
                    } elseif ($totalBelanja >= 500000) {
            
                        $diskon = 0.05;
                        $diskonKeterangan = "Diskon non-member 5% (belanja antara Rp 500.000 dan Rp 1.000.000)";
                    }
                }

                
                $totalDiskon = $totalBelanja * $diskon;
                
                $totalSetelahDiskon = $totalBelanja - $totalDiskon;

                return [
                    'totalSetelahDiskon' => $totalSetelahDiskon,
                    'totalDiskon' => $totalDiskon,
                    'diskonKeterangan' => $diskonKeterangan
                ];
            }

            
            $totalBelanja = $_POST['totalBelanja'];
            $Member = $_POST['Member'] == 1 ? true : false;

            
            $hasil = hitungTotalBelanja($totalBelanja, $Member);
            $totalBayar = $hasil['totalSetelahDiskon'];
            $totalDiskon = $hasil['totalDiskon'];
            $diskonKeterangan = $hasil['diskonKeterangan'];

            
            echo '<div class="result">Total yang harus dibayar: Rp ' . number_format($totalBayar, 0, ',', '.') . '</div>';
            echo '<div class="discount-details">';
            echo '<p>Jumlah diskon: Rp ' . number_format($totalDiskon, 0, ',', '.') . '</p>';
            echo '<p>Keterangan diskon: ' . $diskonKeterangan . '</p>';
            echo '</div>';
            
        }
        ?>

    </div>

</body>

</html>