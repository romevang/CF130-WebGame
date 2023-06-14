const arr = [
    [' ', ' ', ' ', ' ', 'R'],
    [' ', ' ', ' ', ' ', 'G'],
    [' ', ' ', ' ', 'G', 'G'],
    [' ', ' ', ' ', 'G', 'G'],
    [' ', ' ', 'R', 'R', 'R'],
    [' ', ' ', 'G', 'R', 'R'],
];

let rows = 6, cols = 5;

console.log('before: ', arr);
function flipBoard() {
    for (let i = 0; i < cols; i++) {
        let fillTiles = 0;
        for (let j = 0; j < rows; j++) {
            // console.log(`${i} ${j}`, arr[j][i]);
            if (arr[j][i] !== ' ') {
                fillTiles++;
            }
        }

        if (fillTiles > 1) {
            for (k = 0; k < fillTiles / 2; k++) {
                [arr[rows - k - 1][i], arr[rows - fillTiles + k][i]] = [arr[rows - fillTiles + k][i], arr[rows - k - 1][i]];
            }
        }
        fillTiles = 0;
    }
}

flip();
console.log('after: ', arr);