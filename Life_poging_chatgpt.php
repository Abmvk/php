<?php
    // Define board size
    $width = 10;
    $height = 10;

    // Create a blank board
    $board = array();
    for ($i = 0; $i < $height; $i++) {
        $board[$i] = array_fill(0, $width, 0);
    }

    // Seed with some live cells
    $board[2][2] = 1;
    $board[2][3] = 1;
    $board[2][4] = 1;

    // Define the game loop
    for ($iteration = 0; $iteration < 10; $iteration++) {
        // Create a new board for the next iteration
        $newBoard = $board;
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                // Count live neighbors
                $liveNeighbors = 0;
                for ($dx = -1; $dx <= 1; $dx++) {
                    for ($dy = -1; $dy <= 1; $dy++) {
                        if ($dx == 0 && $dy == 0)
                            continue;
                        $nx = $x + $dx;
                        $ny = $y + $dy;
                        if ($nx >= 0 && $nx < $width && $ny >= 0 && $ny < $height && $board[$ny][$nx])
                            $liveNeighbors++;
                    }
                }

                // Apply the rules of the game
                if ($board[$y][$x] && ($liveNeighbors < 2 || $liveNeighbors > 3))
                    $newBoard[$y][$x] = 0;
                elseif (!$board[$y][$x] && $liveNeighbors == 3)
                    $newBoard[$y][$x] = 1;
            }
        }

        // Replace the old board with the new board
        $board = $newBoard;

        // Print the board
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                echo $board[$y][$x] ? '#' : '.';
            }
            echo "\n";
        }
        echo "\n";
    }
?>