document.getElementById('sendTokens').addEventListener('click', function () {
  let sender = document.getElementById('sender_id').value;
  let receiver = document.getElementById('receiver_id').value;
  let amount = document.getElementById('amount').value;
  let message = document.getElementById('message').value;

  //console.log(sender, receiver, amount, message,);
  let formData = new FormData();
  formData.append('sender_id', sender);
  formData.append('receiver_id', receiver);
  formData.append('amount', amount);
  formData.append('message', message);


  fetch('./ajax/savetransfer.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(result => { console.log('Success:', result);
    })
    .catch(error => { console.error('Error:', error);
    });
});

function togSend() {
    var x = document.getElementById("sendmessage");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }


