
function startLiveUpdate(){
    const saldoUpdate = document.getElementById('saldo');

    setInterval(function(){
        fetch('./ajax/refresh.php?id=' + localStorage.getItem('userid')).then(function(response){
            return response.json();  
        }).then(function(data){
            saldoUpdate.textContent = data.body.tokens; 
        }).catch(function(error){
            console.log(error);
        });
    }, 10000);
}

document.addEventListener('DOMContentLoaded', function(){
    startLiveUpdate();
});