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
        if(text.length > 2){
            fetch('./ajax/search.php?name='+ text)
            .then(response => {
                //console.log(response);
                return response.json();
            })
            .then(result => {
                //console.log('im here');
                //console.log(result.body);
                let results = result.body;
                matchlist.innerHTML='';
                addItem(results);
            })
            .catch((error) => console.log(error))
        } else if(text.length<2){
            matchlist.innerHTML='';
        }
    }, 500)
});


function addItem(results) {
    results.forEach(user => {
        // console.log(user['id'] + ' ' + user['name'] + ' ' + user['last_name']);
        let listItem = document.createElement('li');
        listItem.setAttribute("data-id", user['id']);
        listItem.className = 'match_item list-group-item list-group-item-action';                 
        var textnode = document.createTextNode(user['name'] + ' ' + user['last_name']);         
        listItem.appendChild(textnode);                              
        matchlist.appendChild(listItem);
    })
}

matchlist.addEventListener("click", function (e) {
    if (e.target && e.target.matches("li.match_item")) {
        // console.log(e.target.getAttribute('data-id'));
        // console.log(e.target.innerText);
        search.setAttribute('data-id', e.target.getAttribute('data-id'));
        search.value = e.target.innerText;
        search.innerText = e.target.innerText;
        matchlist.innerHTML='';
    }
});

