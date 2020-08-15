
function startLiveUpdate(){
    const saldoUpdate = document.getElementById('saldo');

    setInterval(function(){
        fetch('./ajax/refresh.php?id=' + localStorage.getItem('userid')).then(function(response){
            return response.json();  
        }).then(function(data){
            if(data.body.tokens < 1){
                saldoUpdate.textContent = "You have no tokens!"; 
            }else{
                saldoUpdate.textContent = data.body.tokens; 
            }
        }).catch(function(error){
            console.log(error);
        });
    }, 10000);
}
document.addEventListener('DOMContentLoaded', function(){
    startLiveUpdate();
});