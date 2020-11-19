            State : {
            <?php for ($i = 0; $i <= $jumlahState; $i++) : ?>
                q<?= $i ?>,
            <?php endfor; ?> }
            <br>
            Alphabet : 
            <?php for ($i = 0; $i < strlen($noSpace); $i++) : ?>
                <?= $noSpace[$i] ?>
            <?php endfor; ?>
            <br>
            Start State : { q0 }
            <br>
            Final State : { 
            <?php for ($i = 1; $i < count($finalState); $i++) : ?>
                <?php $finalState[$i] = $finalState[$i - 1] + $finalState[$i] ?>
            <?php endfor; ?>
            <?php for ($i = 0; $i < count($finalState); $i++) : ?>
                q<?= $finalState[$i] ?>
            <?php endfor; ?> }
            <br>
            Fungsi Transisi : <br>
            <?php $temps = 0;
            for ($i = 0; $i < count($cari); $i++) {
                for ($j = 0; $j < strlen($cari[$i]); $j++) {
                    if ($i > 0)
                        if ($temps == $finalState[$i - 1])
                            echo "δ(q0," . $cari[$i][$j] . ") = q" . ++$temps . "<br>";
                        else
                            echo "δ(q" . $temps . ", " . $cari[$i][$j] . ") = q" . ++$temps . "<br>";
                    else
                        echo "δ(q" . $temps . ", " . $cari[$i][$j] . ") = q" . ++$temps . "<br>";
                }
            } ?> 