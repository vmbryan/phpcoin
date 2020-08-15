<?php
    include_once(__DIR__."/Db.php");
        class Transfer{
            private $sender;
            private $receiver;
            private $message;
            private $amount;


            /**
             * Get the value of sender
             */ 
            public function getSender()
            {
                        return $this->sender;
            }

            /**
             * Set the value of sender
             *
             * @return  self
             */ 
            public function setSender($sender)
            {
                        $this->sender = $sender;

                        return $this;
            }

            /**
             * Get the value of receiver
             */ 
            public function getReceiver()
            {
                        return $this->receiver;
            }

            /**
             * Set the value of receiver
             *
             * @return  self
             */ 
            public function setReceiver($receiver)
            {
                        $this->receiver = $receiver;

                        return $this;
            }

            /**
             * Get the value of message
             */ 
            public function getMessage()
            {
                        return $this->message;
            }

            /**
             * Set the value of message
             *
             * @return  self
             */ 
            public function setMessage($message)
            {
                        $this->message = $message;

                        return $this;
            }

            /**
             * Get the value of ammount
             */ 
            public function getAmount()
            {
                        return $this->amount;
            }

            /**
             * Set the value of ammount
             *
             * @return  self
             */ 
            public function setAmount($amount)
            {
                        $this->amount = $amount;

                        return $this;
            }

            public static function viewData(){
                $con = Db::getConnection();
                $stmt = $con->prepare('SELECT id, name, last_name FROM users WHERE name LIKE :name or last_name LIKE :last_name');
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            
            

            public function sendTokens(){
                $con = Db::getConnection();
                $stmt = $con->prepare('INSERT INTO transfers (sender_id, receiver_id, tokens, message) VALUES (:sender_id, :receiver_id, :tokens, :message)');
                $sender =$this->getSender();
                $receiver =$this->getReceiver();
                $amount =$this->getAmount();
                $message = $this->getMessage();

                $stmt->bindValue(":sender_id", $sender);
                $stmt->bindValue(":receiver_id", $receiver);
                $stmt->bindValue(":tokens", $amount);
                $stmt->bindValue(":message", $message); 
                $result = $stmt->execute();

                

                // tokens van de verzender opvragen 
                $stmt2 = $con->prepare('SELECT tokens FROM users WHERE id LIKE :sender_id');
                $stmt2->bindValue(":sender_id", $sender);
                $senderSaldo = $stmt2->execute();
                $senderSaldo = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                $senderSaldo = $senderSaldo['0']['tokens'];
                $senderSaldo = $senderSaldo - $amount;

                // tokens van de ontvanger opvragen 
                $stmt3 = $con->prepare('SELECT tokens FROM users WHERE id LIKE :receiver_id');
                $stmt3->bindValue(":receiver_id", $receiver);
                $receiverSaldo = $stmt3->execute();
                $receiverSaldo = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                $receiverSaldo = $receiverSaldo['0']['tokens'];
                
                $receiverSaldo = $receiverSaldo + $amount;

                // en beiden updaten
                $stmt4 = $con->prepare('UPDATE users SET tokens=:sender_tokens WHERE id=:sender_id');
                $stmt4->bindValue(':sender_tokens', $senderSaldo);
                $stmt4->bindValue(':sender_id', $sender);
                $stmt4->execute();

                $stmt5=$con->prepare('UPDATE users SET tokens=:receiver_tokens WHERE id=:receiver_id');
                $stmt5->bindValue(':receiver_tokens',$receiverSaldo);
                $stmt5->bindValue(':receiver_id',$receiver);
                $stmt5->execute();

                return $result;
            }
            
        }
    