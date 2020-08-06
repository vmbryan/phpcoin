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

                return $result;
            }
        }
    