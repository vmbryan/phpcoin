let errorBlock = document.getElementById('errorblock');
let succesBlock = document.getElementById('succesblock');
errorBlock.style.display='none';
succesBlock.style.display='none';
document.getElementById('sendTokens').addEventListener('click', function () {

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
    errorBlock.style.display="none";
    // checken of hoeveelheid een integer is, niet minder dan 1 etc.
    if(amount == "") throw "Please fill in an amount";
    if(isNaN(amount)) throw "Please specify amount in numbers";
    if(amount > saldo) throw "Amount exceeds current balance";
    if(amount < 1) throw "Amount can not be less than 1";
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
      console.log('Success:', result);

    })
    .catch(error => {
      console.error('Error:', error);
    })
    
  } catch (e) {
    errorBlock.style.display='block';
    errorBlock.innerText = e;
  }


    
});


function togSend() {
    var x = document.getElementById("sendmessage");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }


