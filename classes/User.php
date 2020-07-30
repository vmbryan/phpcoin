<?php
    include_once(__DIR__."/Db.php");
        class User{
            private $name;
            private $lastName;
            private $email;
            private $password;

            

            /**
             * Get the value of name
             */ 
            public function getName()
            {
                        return $this->name;
            }

            /**
             * Set the value of name
             *
             * @return  self
             */ 
            public function setName($name)
            {
                        if(empty($name)){
                                throw new Exception("Name cannot be empty");
                        }
                        $this->name = $name;

                        return $this;
            }

            /**
             * Get the value of lastName
             */ 
            public function getLastName()
            {
                        return $this->lastName;
            }

            /**
             * Set the value of lastName
             *
             * @return  self
             */ 
            public function setLastName($lastName)
            {
                        if(empty($lastName)){
                                throw new Exception("Last name cannot be empty");
                        }
                        $this->lastName = $lastName;

                        return $this;
            }

            /**
             * Get the value of email
             */ 
            public function getEmail()
            {
                        return $this->email;
            }

            /**
             * Set the value of email
             *
             * @return  self
             */ 
            public function setEmail($email)
            {
                        if(empty($email)){
                                throw new Exception("Email cannot be empty");
                        }
                        $this->email = $email;

                        return $this;
            }

            /**
             * Get the value of password
             */ 
            public function getPassword()
            {
                        return $this->password;
            }

            /**
             * Set the value of password
             *
             * @return  self
             */ 
            public function setPassword($password)
            {
                        if(empty($password)){
                                throw new Exception("Password cannot be empty");
                        }
                        $this->password = $password;

                        return $this;
            }


            public function userExists(){
                $con = Db::getConnection();
                $email = $_POST['email'];
                $stmt = $con->prepare( 'SELECT email FROM users WHERE email = :email');
                $stmt->bindValue( ':email', $email );
                $stmt->execute();
                $result = $stmt->fetchAll();
                if(!empty($result)){ // if results are found
                    throw new Exception("Email adres is already in use");
                }
                return false;
            }

            public function saveUser(){
                $con = Db::getConnection();
                $stmt = $con->prepare('INSERT INTO users (name, last_name, email, password, tokens) VALUES (:name, :lastName, :email, :password, 10)');
                $name =$this->getName();
                $lastName =$this->getLastName();
                $email =$this->getEmail();
                $password = $this->getPassword();
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $stmt->bindValue(":name", $name);
                $stmt->bindValue(":lastName", $lastName);
                $stmt->bindValue(":email", $email);
                $stmt->bindValue(":password", $password); 
                $result = $stmt->execute();

                return $result;
            }
        }