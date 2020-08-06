let search  = document.getElementById('receiver_id');
let matchlist = document.getElementById('match_list');
let matchItem = document.querySelector('.match_item');
// We maken een timer aan
let timer = null;
search.addEventListener('input', function (event) { //debounce
    if (timer) {
        clearTimeout(timer)
    }
    // Er is iets getypt in het tekstvak
    timer = setTimeout(() => {
        // Er is 1 seconde verlopen since de laatste keystroke
        // Hier gaan we de gegevens ophalen
        const text = search.value;
        fetch('./ajax/search.php?name='+ text)
            .then(response => {
                console.log(response);
                return response.json();
            })
            .then(result => {
                console.log('im here');
                console.log(result.body);
                let results = result.body;
                addItem(results);
            })
            .catch((error) => console.log(error))
    }, 1000)
});


function addItem(results) {
    results.forEach(user => {
        // console.log(user['id'] + ' ' + user['name'] + ' ' + user['last_name']);
        let listItem = document.createElement('li');
        listItem.setAttribute("data-id", user['id']);
        listItem.className = 'match_item';                 
        var textnode = document.createTextNode(user['name'] + ' ' + user['last_name']);         
        listItem.appendChild(textnode);                              
        matchlist.appendChild(listItem);
    })
}



