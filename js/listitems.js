

let user_id = localStorage.getItem("userid");


function createTransferItem(transfers){
    
    transfers.forEach(transfer => {

    let tokens = parseInt(transfer.tokens);

    let transfer_id = transfer.id;

    let transfers = document.getElementById("transfers");
    let transfer_item = document.createElement("ARTICLE");
    let transfer_item_header = document.createElement("HEADER");
    let transfer_item_desc = document.createElement("H2");
    let transfer_item_amount = document.createElement("P");
    let transfer_item_details_btn = document.createElement("DETAILS");
    let transfer_item_details_tag = document.createElement("SUMMARY");
    let transfer_item_message = document.createElement("P");

    transfer_item.className = "transfer_item";
    transfer_item_header.className = "transfer_item_header";
    transfer_item_desc.className = "transfer_item_desc";
    transfer_item_amount.className = "transfer_item_amount";
    transfer_item_details_btn.className = "transfer_item_details_btn";
    transfer_item_details_tag.className = "transfer_item_details_tag";
    transfer_item_message.className = "transfer_item_message";

    transfer_item.setAttribute('data-transfer-id', transfer_id);
    transfer_item_header.setAttribute('data-transfer-id', transfer_id);
    transfer_item_desc.setAttribute('data-transfer-id', transfer_id);
    transfer_item_amount.setAttribute('data-transfer-id', transfer_id);
    transfer_item_details_btn.setAttribute('data-transfer-id', transfer_id);
    transfer_item_details_tag.setAttribute('data-transfer-id', transfer_id);
    transfer_item_message.setAttribute('data-transfer-id', transfer_id);

    transfer_item.appendChild(transfer_item_header);
    transfer_item_header.appendChild(transfer_item_desc);
    transfer_item_header.appendChild(transfer_item_amount);
    transfer_item.appendChild(transfer_item_details_btn);
    transfer_item_details_btn.appendChild(transfer_item_details_tag);
    transfer_item_details_btn.appendChild(transfer_item_message);

    transfer_item_amount.innerText = tokens;
    
    
    if(transfer.sender_id === user_id){
        transfer_item_amount.innerText = '-' + tokens;
        transfer_item_amount.className = 'transfer_item_amount minus';
        let receiver_id = transfer.receiver_id;
        fetch('./ajax/names.php?id=' + receiver_id).then(function(response){
            return response.json();  
        }).then(function(result){
            let receiver_name = result.name;
            let desc = document.createTextNode("You sent " + receiver_name + " " + tokens + " cents");
            transfer_item_desc.appendChild(desc);
        }).catch(function(error){
            console.log(error);
        });
    }else{
        transfer_item_amount.innerText = '+' + tokens;
        transfer_item_amount.className = 'transfer_item_amount plus';
        let sender_id = transfer.sender_id;
        fetch('./ajax/names.php?id=' + sender_id).then(function(response){
            return response.json();  
        }).then(function(result){
            let sender_name = result.name;
            let desc = document.createTextNode(sender_name + " sent you " + tokens + " cents");
            transfer_item_desc.appendChild(desc);
        }).catch(function(error){
            console.log(error);
        });
    }

    fetch('./ajax/message.php?id=' + transfer.id).then(function(response){
        return response.json();  
    }).then(function(result){
        let message = document.createTextNode(result.body.message);
        transfer_item_message.appendChild(message);

    }).catch(function(error){
        console.log(error);
    });

    transfers.appendChild(transfer_item);
    })

    
}

function loadItems(id){
    fetch('./ajax/transfers.php?id=' + id).then(function(response){
        return response.json();  
    }).then(function(result){
        let transfers = result.body;
        createTransferItem(transfers);

    }).catch(function(error){
        console.log(error);
    });
}



document.addEventListener('DOMContentLoaded', function(){

    loadItems(user_id);
});