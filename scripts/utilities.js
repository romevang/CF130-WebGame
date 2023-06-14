function pad(value) {
    return value > 9 ? value + "" : "0" + value;
}

function parseDisplayTime(_totalSec) {
    try {
        timeVal = "";
        let totalSec = _totalSec;
        //calculate hour
        let hour = parseInt(totalSec / 3600);
        timeVal += pad(hour);
        totalSec = totalSec - hour * 3600;

        //calculate min
        let min = parseInt(totalSec / 60);
        timeVal += ":" + pad(min);

        //calculate sec
        totalSec = totalSec - min * 60;
        timeVal += ":" + pad(totalSec);
        return timeVal;
    } catch (error) {
        console.error('Error occurs while time conversion: ', error);
    }
}

function getPlayerName(player) {
    return player.slice(0, player.length - 2);
}

function containsChild(parent, child) {
    for(let i = 0; i < parent.childElementCount; ++i) {
        if (parent.children[i] === child) return true;
    }
    return false;
}

function removeBorder(elementArr) {
    for(let i = 0; i < elementArr.childElementCount; ++i) {
        elementArr.children[i].style.border = 'none';
    }
}