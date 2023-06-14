function suggestLastStep() {
    const { rows, cols } = gameState;
    let curPos = [];
    for (let i = 0; i < rows; ++i) {
        for (let j = 0; j < cols; ++j) {
            if (i === gameState.currCols[j] - 1) {
                // console.log('horizontalCheck');
                curPos = horizontalCheck(i, j);
                if (curPos.length === 2) return curPos;

                // console.log('verticalCheck');
                curPos = verticalCheck(i, j);
                if (curPos.length === 2) return curPos;

                // console.log('antiDiagonalCheck');
                curPos = antiDiagonalCheck(i, j);
                if (curPos.length === 2) return curPos;

                // console.log('diagonalCheck');
                curPos = diagonalCheck(i, j);
                if (curPos.length === 2) return curPos;
            }
        }
    }

    return curPos;
}

function horizontalCheck(row, col) {
    const { board, currPlayer, cols } = gameState;
    let hintPos = [];
    let curVal = '';
    let numberOfBlank = 0;
    if (col > cols - 4) {
        return [];
    }
    if (currPlayer === player1) curVal = player2;
    else if (currPlayer === player2) curVal = player1;
    for (let i = 0; i < 4; ++i) {
        if (numberOfBlank > 1) {
            return [];
        }
        if (board[row][col + i] === curVal) {
            return [];
        }
        else if (board[row][col + i] === ' ') {
            if (numberOfBlank < 1) {
                hintPos = [row, col + i];
            }
            ++numberOfBlank;
        }
    }
    return numberOfBlank === 1 ? hintPos : [];
}

function verticalCheck(row, col) {
    const { board, currPlayer, rows } = gameState;
    let hintPos = [];
    let curVal = '';
    let numberOfBlank = 0;
    if (row > rows - 4) {
        return [];
    }
    if (currPlayer === player1) curVal = player2;
    else if (currPlayer === player2) curVal = player1;
    for (let i = 0; i < 4; ++i) {
        if (numberOfBlank > 1) {
            return [];
        }
        if (board[row + i][col] === curVal) {
            return [];
        }
        else if (board[row + i][col] === ' ') {
            if (numberOfBlank < 1) {
                hintPos = [row + i, col];
            }
            ++numberOfBlank;
        }
    }
    return numberOfBlank === 1 ? hintPos : [];
}

function antiDiagonalCheck(row, col) {
    const { board, currPlayer, rows, cols } = gameState;
    let hintPos = [];
    let curVal = '';
    let numberOfBlank = 0;
    if (row > rows - 4 || col > cols - 4) {
        return [];
    }
    if (currPlayer === player1) curVal = player2;
    else if (currPlayer === player2) curVal = player1;
    for (let i = 0; i < 4; ++i) {
        if (numberOfBlank > 1) {
            return [];
        }
        if (board[row + i][col + i] === curVal) {
            return [];
        }
        else if (board[row + i][col + i] === ' ') {
            if (numberOfBlank < 1) {
                hintPos = [row + i, col + i];
            }
            ++numberOfBlank;
        }
    }
    return numberOfBlank === 1 ? hintPos : [];
}

function diagonalCheck(row, col) {
    const { board, currPlayer, rows, cols } = gameState;
    let hintPos = [];
    let curVal = '';
    let numberOfBlank = 0;
    if (row > rows - 4 || cols - col + 1 >= 4) {
        return [];
    }
    if (currPlayer === player1) curVal = player2;
    else if (currPlayer === player2) curVal = player1;
    for (let i = 0; i < 4; ++i) {
        if (numberOfBlank > 1) {
            return [];
        }
        if (board[row + i][col - i] === curVal) {
            return [];
        }
        else if (board[row + i][col - i] === ' ') {
            if (numberOfBlank < 1) {
                hintPos = [row + i, col - i];
            }
            ++numberOfBlank;
        }
    }
    return numberOfBlank === 1 ? hintPos : [];
}