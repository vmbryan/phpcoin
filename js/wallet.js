let errorBlock = document.getElementById('errorblock');
let succesBlock = document.getElementById('succesblock');
errorBlock.style.display='none';
succesBlock.style.display='none';
const transfers = document.getElementById('transfers');
document.getElementById('sendTokens').addEventListener('click', function () {

  if (confirm('Are you sure you want to proceed?')) {
    // id van de ontvanger
    let receiver = document.getElementById('receiver_id');
    receiver = receiver.dataset.id;

    // hoeveelheid + parsen naar int zodat we ermee kunnen tellen.
    let amount = document.getElementById('amount').value;
    amount = parseInt(amount);

    // het huidige saldo, ook geparsed naar int zodat wer ermee kunnen tellen.
    let saldo = document.getElementById('saldo');
    saldo = saldo.textContent;
    saldo = parseInt(saldo);

    // de boodschap
    let message = document.getElementById('message').value;



    try {

      // checken of hoeveelheid een integer is, niet minder dan 1 etc.
      if (amount == "") throw "Please fill in an amount";
      if (isNaN(amount)) throw "Please specify amount in numbers";
      if (amount > saldo) throw "Amount exceeds current balance";
      if (amount < 1) throw "Amount can not be less than 1";
      if (document.getElementById('receiver_id').value == "") throw "Please select a recipient.";

      let formData = new FormData();
      // ID van de zender geven we al mee via PHP
      formData.append('receiver_id', receiver);
      formData.append('amount', amount);
      formData.append('message', message);

      fetch('./ajax/savetransfer.php', {
        method: 'POST',
        body: formData
      })
        .then(response => {
          return response.json();
        })
        .then(result => {
          document.getElementById('receiver_id').value = null;
          document.getElementById('amount').value = null;
          document.getElementById('message').value = null;

          succesBlock.style.display = 'Block';
          succesBlock.innerText = 'Tokens sent succesfully!';
          saldo.innerText = getCurrentBalance();

        })
        .catch(error => {
          console.error('Error:', error);
        })

    } catch (e) {
      errorBlock.style.display = 'block';
      errorBlock.innerText = e;
    }



  }

});


transfers.addEventListener("click", function (e) {
  if (e.target && e.target.matches("li.transfer_item")){
      let transferId = e.target.getAttribute('data-transferId');
      fetch('./ajax/message.php?id=' + transferId).then(function (response) {
        return response.json();
      }).then(function (data) {
        let cardbody = document.getElementById('cardbody'+transferId);
        let cardMessage = document.getElementById('transferMessage'+transferId);
        cardbody.className = "card-body p-2 d-flex justify-content-between mb-0 border-bottom border-gray";
        cardMessage.innerText = data.body.message;
        console.log(data.body.message);
      }).catch(function (error) {
        console.log(error);
      });

  }
});



function getCurrentBalance(){
  fetch('./ajax/refresh.php?id=' + localStorage.getItem('userid')).then(function (response) {
    return response.json();
  }).then(function (data) {
    return data.body.tokens;
  }).catch(function (error) {
    console.log(error);
  });
}

function togSend() {
    errorBlock.style.display="none";
    succesBlock.style.display='none';
    let x = document.getElementById("sendmessage");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }


