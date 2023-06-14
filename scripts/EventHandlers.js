function onChangeOption(e) {
  try {
    let selectedOpt = e.target.value;
    let [width, height] = OPTIONS[selectedOpt];
    gameState.rows = width;
    gameState.cols = height;
    isGameModeChosen = true;
  } catch (error) {
    console.log(`%c Error occured with on change option: ${error}`, 'background: red; padding: 0.2rem');
  }
}

function onBtnPlayGameClick(e) {
  // when clicking play button the modal disappears, timer stars
  modal?.classList.remove('open');
  intervalId = setInterval(() => {
    timerEl.textContent = parseDisplayTime(gameState.counter);
    ++gameState.counter;
  }, TIMEOUT);

  // set some basic settings
  currentPlayerEl?.classList.remove('close');
  currentPlayerEl.style.color = gameState.player1Color;
  currentPlayerEl.textContent = getPlayerName(player1) + '\'s Turn';
  flipBoardBtn.classList.remove('close');
}

function onHandleColorPickerClickForPlayer1(e) {
  if (e.target.style.backgroundColor === gameState.player2Color) return;
  let colorOpts1 = document.querySelector('.color-options-player1');
  if(colorOpts1) {
    removeBorder(colorOpts1);
  }
  gameState.player1Color = e.target.style.backgroundColor;
  colorPlayer1H1.style.color = e.target.style.backgroundColor;
  e.target.style.border = '2px solid gray';
}

function onHandleColorPickerClickForPlayer2(e) {
  if (e.target.style.backgroundColor === gameState.player1Color) return;
  let colorOpts2 = document.querySelector('.color-options-player2');
  if(colorOpts2) {
    removeBorder(colorOpts2);
  }
  gameState.player2Color = e.target.style.backgroundColor;
  colorPlayer2H1.style.color = e.target.style.backgroundColor;
  e.target.style.border = '2px solid gray';
}

function onBtnStartGameClick(e) {
  e.preventDefault();
  // check if the size of board is choosen or not
  if (!isGameModeChosen) {
    document.querySelector('.size-options').focus();
    return;
  }

  // check if players name are empty
  if (!gameState.isStarted) {
    if (checkPlayerName()) {
      if (player1NameEl?.value === '') {
        player1NameEl?.focus();
        return;
      }
      if (player2NameEl?.value === '') {
        player2NameEl?.focus();
        return;
      }
    }

    setOriginCurPlayer();
    // open the modal for players to choose their favorite colors
    modal?.classList.add('open');

    winnerEl?.classList.add('close');
    currentPlayerEl?.classList.add('close');
    colorPickerEl?.classList.remove('close');

    // draw game-table to the screen
    drawTable();
    gameState.isStarted = true;
    if (button) {
      button.value = "Restart";
      gameMode.classList.add('close');
    }
    setGame();
    return;
  }
  winnerEl && winnerEl.classList.remove('close');
  colorPickerEl?.classList.add('close');
  resetGame();
}

function onBtnPlayAgainClick() {
  resetGame();
}

function checkPlayerName() {
  return player1NameEl?.textContent === '' || player2NameEl?.textContent === '';
}

function setOriginCurPlayer() {
  gameState.currPlayer = player1;
  currentPlayerEl.textContent = getPlayerName(player1);
  currentPlayerEl.style.color = gameState.player1Color;
}

function resetGame() {
  if (timerEl) {
    timerEl.textContent = "00:00:00";
  }
  if (button) {
    button.value = "Start game";
    gameMode.classList.remove('close');
  }
  // 
  modal?.classList.remove('open');
  flipBoardBtn.classList.add('close');

  // reset game state: it's default value base on default constant value
  gameState = { ...defaultValueGame };
  initBoard();
  // set current player to player 1
  setOriginCurPlayer();
  console.log(gameState);
  currentPlayerEl?.classList.add('close');

  // set default value for game-mode (board size selection)
  gameMode.getElementsByTagName('option')[0].selected = 'selected';
  isGameModeChosen = false;

  // remove game table to init new one for next games
  let gameTable = document.querySelector('.game-table');
  if (gameTable) gameTable.remove();
  if (intervalId) clearInterval(intervalId);
}

function onHandleName1Change(e) {
  if (e.target?.value) {
    colorPlayer1H1.textContent = e.target.value;
    colorPlayer1H1.style.color = gameState.player1Color;
    player1 = e.target.value + "-1"
  }
}

function onHandleName2Change(e) {
  if (e.target?.value) {
    colorPlayer2H1.textContent = e.target.value;
    colorPlayer2H1.style.color = gameState.player2Color;
    player2 = e.target.value + "-2"
  }
}

function onClickFlipBoardBtn() {
  if (gameState.currPlayer === player1) {
    gameState.player1FlipLeft = 0;
  }
  else if (gameState.currPlayer === player2) {
    gameState.player2FlipLeft = 0;
  }
  flipBoardBtn.classList.add('close');
  flipBoard();
  updateGameTable();
}

function onLoad() {
  flipBoardBtn.classList.add('close');
  renderColorPicker();
}