<!DOCTYPE html>
<html>
<head>
    <title>Yes or No Answer</title>
</head>
<body>
    <form method="post">
        <label>Ask your question:</label><br>
        <input type="text" name="question" required value="<?php echo isset($_POST['question']) ? htmlspecialchars($_POST['question']) : ''; ?>">
        <button type="submit">Ask</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['question'])) {
        // Define answer probabilities (percentages)
        $probabilities = [
            'yes' => 70,
            'no' => 29,
            'maybe' => 0.001,
        ];

        $rand = mt_rand(1, 100);
        $cumulative = 0;
        $selectedAnswer = '';
        $selectedPercent = 0;

        foreach ($probabilities as $answer => $percent) {
            $cumulative += $percent;
            if ($rand <= $cumulative) {
                $selectedAnswer = $answer;
                $selectedPercent = $percent;
                break;
            }
        }

        echo "<p>" . htmlspecialchars($_POST['question']) ."</p>";
        echo "<p>$selectedAnswer ({$selectedPercent}%)</p>";
    }
    ?>
</body>
</html>
