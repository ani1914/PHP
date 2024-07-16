function editPlayer(playerId, playerNumber, playerPosition,playerName, playerBirthdate, playerGoals, playerAssists, playerYellowCards, playerRedCards) {
    document.getElementById('edit_id').value = playerId;
    document.getElementById('edit_number').value = playerNumber;
    document.getElementById('edit_position').value = playerPosition;
    document.getElementById('edit_name').value = playerName;
    document.getElementById('edit_birthdate').value = playerBirthdate;
    document.getElementById('edit_goals').value = playerGoals;
    document.getElementById('edit_assists').value = playerAssists;
    document.getElementById('edit_yellow_cards').value = playerYellowCards;
    document.getElementById('edit_red_cards').value = playerRedCards;
}

function showSuccessMessage(message) {
    var messageDiv = document.getElementById('message');
    messageDiv.innerHTML = message;
    messageDiv.style.display = 'block';
    setTimeout(function() {
        messageDiv.style.display = 'none';
    }, 3000);
}