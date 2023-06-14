//session variable coudln't be used in this file
let userid = null;

let intervalId = null;
let timerEl = document.querySelector('.timer');;
let button = document.querySelector('.start-game-btn');
let gameMode = document.querySelector('.game-mode');
let winnerEl = document.querySelector('.winner-container');
let colorPickerEl = document.querySelector('.color-picker');
let colorPlayer1El = colorPickerEl.querySelector('.color-player-1')
let colorPlayer2El = colorPickerEl.querySelector('.color-player-2');
let modal = document.querySelector(".modal");
const selectTag = document.querySelector('select');
const startBtn = document.querySelector('.start-game-btn');
const playAgainBtn = document.querySelector('.play-again-btn');
const playBtn = document.querySelector('.play-game-btn');
const player1NameEl = document.getElementById('player1');
const player2NameEl = document.getElementById('player2');
let colorPlayer1H1 = document.querySelector('.color-player-1 h1');
let colorPlayer2H1 = document.querySelector('.color-player-2 h1');
let currentPlayerEl = document.querySelector('.current-player');
let flipBoardBtn = document.querySelector('.flip-btn');
let abcBtn = document.querySelector('.abc-btn');
let hintTile = null;
let lastHintPos = null;

//Game variables for current session
let player1 = 'Player 1';
let player2 = 'Player 2';
let wins = 1;
let playTime = 0;
let playCount = 1;


let defaultValueGame = {
    isStarted: false,
    counter: 0,
    currPlayer: '',
    player1Color: COLOR_OPTIONS[0],
    player2Color: COLOR_OPTIONS[1],
    rows: 6, // default value
    cols: 7, // default value
    currCols: [],
    board: [],
    player1FlipLeft: 1,
    player2FlipLeft: 1,
    isOver: false,
    hintPos: null,
}

let gameState = { ...defaultValueGame };

let isGameModeChosen = false;

function drawTable() {
    let table = new DynamicTable(gameState.rows, gameState.cols, {
        tableStyle: 'game-table',
        rowStyle: 'row',
        colStyle: 'col',
    });

    //clear the old game table
    let wrapperNode = document.querySelector('.wrapper');
    let numOfChild = wrapperNode.children.length;
    if (numOfChild > 0) {
        for (let i = 0; i < numOfChild; ++i) {
            if (wrapperNode.children[i].className === 'game-table') {
                wrapperNode.children[i].remove();
                break;
            }
        }
    }
    wrapperNode.appendChild(table.tableEl);
}

// explanation for the flip algorithm
/*
    first, counting the number of filled tiles and check if it is greater than 1 or not
    if so, we swap values of two corresponding tiles:
    rows - k - 1 and rows - fillTiles + k
    let me explain:
    let arr = [
        [' ', ' ', ' ', 'G', ' '],
        [' ', ' ', ' ', 'G', ' '],
        [' ', ' ', ' ', 'G', 'R'],
        [' ', ' ', ' ', 'G', 'G'],
        [' ', ' ', ' ', 'R', 'G'],
    ]
    numberOfRows = 5
    numberOfCols = 5
    in case fillTiles = 5, the current col is 3 (index), we will have
    k from 0 to fullTiles / 2 - 1 (divided by 2 because we will do something like symmetrical swap)
    i is current cols, in this is case i is 3
    k = 0
    arr[5 - 0 - 1][3] swap value with arr[5 - 5  + 0][3] => we have arr[4][3] and arr[0][3] => it's G and R
    
    keep doing that untils we get to the end of the board
*/
function flipBoard() {
    const { cols, rows, board } = gameState;
    for (let i = 0; i < cols; i++) {
        let fillTiles = 0;
        for (let j = 0; j < rows; j++) {
            if (board[j][i] !== ' ') {
                fillTiles++;
            }
        }

        if (fillTiles > 1) {
            for (k = 0; k < fillTiles / 2; k++) {
                [board[rows - k - 1][i], board[rows - fillTiles + k][i]] = [board[rows - fillTiles + k][i], board[rows - k - 1][i]];
            }
        }
        fillTiles = 0;
    }
    console.log(board);
}

function updateGameTable() {
    let { rows, cols, board, player1Color, player2Color } = gameState;
    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < cols; j++) {
            if (board[i][j] === player1) {
                let tile = document.getElementById(`${i}-${j}`);
                if (tile) {
                    tile.style.backgroundColor = player1Color;
                }
            }
            else if (board[i][j] === player2) {
                let tile = document.getElementById(`${i}-${j}`);
                if (tile) {
                    tile.style.backgroundColor = player2Color;
                }
            }
        }
    }
}

function renderColorPicker() {
    let colorOpt1 = createColorOptionForPlayer1();
    let colorOpt2 = createColorOptionForPlayer2();

    colorOpt1.children[0].style.border = '2px solid gray';
    colorOpt2.children[1].style.border = '2px solid gray';
    gameState.player1Color = colorOpt1.children[0].style.backgroundColor;
    gameState.player2Color = colorOpt2.children[1].style.backgroundColor;

    if (!containsChild(colorPlayer1El, colorOpt1)) {
        colorPlayer1El.appendChild(colorOpt1);
    }
    if (!containsChild(colorPlayer2El, colorOpt2)) {
        colorPlayer2El.appendChild(colorOpt2);
    }
}

function createColorOptionForPlayer1() {
    let colorOpts = COLOR_OPTIONS.map(colorOp => {
        let div = document.createElement('div');
        div.classList.add('color');
        div.style.backgroundColor = colorOp;
        div.addEventListener('click', onHandleColorPickerClickForPlayer1);
        return div;
    });
    let colorOptsWrapper = document.createElement('div');
    colorOptsWrapper.className = 'color-options-player1';
    colorOptsWrapper.append(...colorOpts);
    return colorOptsWrapper;
}

function createColorOptionForPlayer2() {
    let colorOpts = COLOR_OPTIONS.map(colorOp => {
        let div = document.createElement('div');
        div.classList.add('color');
        div.style.backgroundColor = colorOp;
        div.addEventListener('click', onHandleColorPickerClickForPlayer2);
        return div;
    });
    let colorOptsWrapper = document.createElement('div');
    colorOptsWrapper.className = 'color-options-player2';
    colorOptsWrapper.append(...colorOpts);
    return colorOptsWrapper;
}


function initBoard() {
    gameState.board = [];
    for (let r = 0; r < gameState.rows; r++) {
        let row = [];
        for (let c = 0; c < gameState.cols; c++) {
            row.push(' ');
        }
        gameState.board.push(row);
    }
}

function setGame() {
    const { rows, cols } = gameState;
    gameState.currCols = Array(cols).fill(rows);
    console.log(gameState.currCols);
    drawTable();
    let gameTableRows = document.querySelectorAll('.game-table .row');

    // init game data - the board for checking winner
    initBoard();
    gameTableRows.forEach(row => {
        for (let col = 0; col < row.children.length; col++) {
            row.children[col].addEventListener('click', setPiece);
            // console.log(row.c[col]);
        }
    });

    console.log(gameState.board);
}

function setPiece() {
    if (gameState.gameOver) {
        return;
    }

    //get coords of that tile clicked
    let coords = this.id.split("-");
    let r = parseInt(coords[0]);
    let c = parseInt(coords[1]);

    // figure out which row the current column should be on
    r = gameState.currCols[c];

    if (r < 0) { // board[r][c] != ' '
        return;
    }

    gameState.board[r - 1][c] = gameState.currPlayer; //update JS board

    // every player takes turn and fill tiles with their color
    let tile = document.getElementById((r - 1).toString() + "-" + c.toString());
    if (gameState.currPlayer === player1) {
        tile.style.backgroundColor = gameState.player1Color;
        gameState.currPlayer = player2;
        currentPlayerEl.textContent = getPlayerName(player2) + '\'s Turn';
        currentPlayerEl.style.color = gameState.player2Color;

        // check if the flip's number of each player
        if (gameState.player2FlipLeft > 0) {
            flipBoardBtn.classList.remove('close');
        }
        else if (gameState.player2FlipLeft === 0) {
            flipBoardBtn.classList.add('close');
        }
    }
    else {
        tile.style.backgroundColor = gameState.player2Color;
        gameState.currPlayer = player1;
        currentPlayerEl.textContent = getPlayerName(player1) + '\'s Turn';
        currentPlayerEl.style.color = gameState.player1Color;
        if (gameState.player1FlipLeft > 0) {
            flipBoardBtn.classList.remove('close');
        }
        else if (gameState.player1FlipLeft === 0) {
            flipBoardBtn.classList.add('close');
        }
    }

    r -= 1; //update the row height for that column
    gameState.currCols[c] = r; //update the array

    checkWinner();
    hideHintTile();
    gameState.hintPos = suggestLastStep();
    if (gameState.hintPos.length === 2 && gameState.isStarted) {
        showHintTile();
    }
}

function showHintTile() {
    if (gameState.hintPos && Array.isArray(gameState.hintPos)) {
        hintTile = document.getElementById(`${gameState.hintPos[0]}-${gameState.hintPos[1]}`);
        if (hintTile) hintTile.style.border = "1px solid #32CD32";

    }
}

function hideHintTile() {
    if (gameState.hintPos && Array.isArray(gameState.hintPos)) {
        hintTile = document.getElementById(`${gameState.hintPos[0]}-${gameState.hintPos[1]}`);
        if (hintTile) hintTile.style.border = "none";
    }
}

function checkWinner() {
    const { rows, cols: columns, board } = gameState;
    // horizontal
    for (let r = 0; r < rows; r++) {
        for (let c = 0; c < columns - 3; c++) {
            if (board[r][c] != ' ') {
                if (board[r][c] == board[r][c + 1] && board[r][c + 1] == board[r][c + 2] && board[r][c + 2] == board[r][c + 3]) {
                    setWinner(r, c);
                    console.log('horizontal');
                    return;
                }
            }
        }
    }

    // vertical
    for (let c = 0; c < columns; c++) {
        for (let r = 0; r < rows - 3; r++) {
            if (board[r][c] != ' ') {
                if (board[r][c] == board[r + 1][c] && board[r + 1][c] == board[r + 2][c] && board[r + 2][c] == board[r + 3][c]) {
                    setWinner(r, c);
                    console.log('vertical');
                    return;
                }
            }
        }
    }

    // anti diagonal
    for (let r = 0; r < rows - 3; r++) {
        for (let c = 0; c < columns - 3; c++) {
            if (board[r][c] != ' ') {
                if (board[r][c] == board[r + 1][c + 1] && board[r + 1][c + 1] == board[r + 2][c + 2] && board[r + 2][c + 2] == board[r + 3][c + 3]) {
                    setWinner(r, c);
                    console.log('anti diagonal');
                    return;
                }
            }
        }
    }

    // diagonal
    for (let r = 3; r < rows; r++) {
        for (let c = 0; c < columns - 3; c++) {
            if (board[r][c] != ' ') {
                if (board[r][c] == board[r - 1][c + 1] && board[r - 1][c + 1] == board[r - 2][c + 2] && board[r - 2][c + 2] == board[r - 3][c + 3]) {
                    setWinner(r, c);
                    console.log('diagonal');
                    return;
                }
            }
        }
    }

    r = -2; c = -2;
    for (let i = 0; i < rows; ++i) {
        for (let j = 0; j < columns; ++j) {
            if (board[i][j] === ' ') {
                setWinner(-1, -1);
                return;
            }
        }
    }

    setWinner(r, c);
}

function setWinner(r, c) {
    let winnerSpan = modal.querySelector('.winner');
    winnerSpan.style.color = '#000';
    winnerEl?.classList.remove('close');
    colorPickerEl?.classList.add('close');
    let userName = document.getElementById("player1").value;
    let userName2 = document.getElementById("player2").value;

    // if row = -2 and c = -2 we haven't got the winner
    if (r === -2 && c === -2) {
        winnerSpan.textContent = 'Draw';
        modal.classList.add('open');
    }

    // if row = -1 and c = -1 we haven't got the winner
    if (r === -1 && c === -1) {
        return;
    }

    // check if the winner is player 1 or player 2
    if (r > -1 && c > -1) {
        if (gameState.board[r][c] === player1) {
            winnerSpan.innerText = userName;
            winnerSpan.style.color = gameState.player1Color;
            //send stats to database, doesn't work
            sendStats(userid, wins, playcount);  
        } else {
            winnerSpan.innerText = userName2;
            winnerSpan.style.color = gameState.player2Color;

        }
        modal.classList.add('open');
    }
    gameState.isStarted = false;
    // console.log(gameState.board[r][c]);
}
//Function to send stats to database, called in setWinner function
//Couldn't get userid to work, but if set to an integer it works
function sendStats(userid, wins, playcount){
    let a= new Array;
    a[0] = userid;
    a[1] = wins;
    a[2]= playcount;
    //a[3] = time;
    console.log(a);
    strArr = JSON.stringify(a);

    httpRequest = new XMLHttpRequest();
    if(!httpRequest){
        alert("No XMLHTTP instance");
        return false;
    }

    httpRequest.open('POST','updatePOST.php');
    httpRequest.setRequestHeader('content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send('Array='+strArr);
}
//Function to grab userid from login.php hack that didn't work.
function grabsession(uid){
    userid = uid;
}