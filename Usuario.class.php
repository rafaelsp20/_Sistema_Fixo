<?php

abstract class Conexao{

    /*nesta classe só utilizo o meu user e a senha do do DB*/
    const USER = "root";
    const PASS = "";

    private static $instance = null;

    private static function conectar(){

        try{
            if(self::$instance == null):
                /*Abaixo mostro a instancia de qual DB estou utilizando e o nome do database*/
                $dsn = "mysql:host=localhost;dbname=meu_sistema";
                self::$instance = new PDO($dsn, self::USER, self::PASS);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            endif;
        }catch (PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
        return self::$instance;
    }

    protected static function getDB(){
        return self::conectar();
    }

}

?>

<?php

    class Login extends Conexao{

        private $login;
        private $senha;

        public function setLogin($login){
             $this->login = $login;
        }
        public function setSenha($senha){
            $this->senha = $senha;
        }
        public function getLogin(){
            return $this->login;
        }
        public function getSenha(){
            return $this->senha;
        }


        public function logar(){
            $pdo = parent::getDB();
            
            /*faço meu select com o banco de dados já criado*/
            $logar = $pdo->prepare ("SELECT * FROM usuario WHERE email = ? AND senha = ?");
            $logar->bindValue(1, $this->getLogin());
            $logar->bindValue(2, $this->getSenha());
            $logar->execute();
            if ($logar->rowCount()== 1):
                $dados = $logar->fetch(PDO::FETCH_OBJ);
                
                /*neste ponto informo a tabela que contem o dados do usurário*/
                $_SESSION['usuario'] = $dados->nome;
                
                /*Aqui informo se o mesmo se encontra logado*/
                $_SESSION['logado'] = true;


                return true;
            else:
                return false;
            endif;
        }

        public static function deslogar(){
            if(isset($_SESSION['logado'])):
                unset($_SESSION['logado']);
                session_destroy();
                header("http://localhost:8080/SistemaLoginPDO/");
            endif;
        }
    }
?>
</body>
</html>


