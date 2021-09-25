<?php

declare(strict_types=1);

class Produto
                    {

                    private $conexao;

                    public function __construct()
                    {
                        try{
                            $this->conexao = new PDO('mysql:host=localhost;dbname=ddctelefones02', 'root', '');

                            }catch(Exception $e){

                                    echo "ERRO: " .$e->getMessage();
                                    die();
                        }
                    }

                    public function list1 (): void
                    
                    {
                 
                         
                         $query = $this->conexao-> prepare ("SELECT * FROM produtos");     
                         $query->execute();
 
 
 
                         echo '<div class="col-lg-9"> 
                         <table class="table table-bordered">
                           <thead>
                             <tr>
                               <th>Nº</th>
                               <th>Nome</th>
                               <th>Sobrenome</th>
                               <th>Usuário</th>
                             </tr>
                           </thead>';
                         
                                 while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                 $id = $row["id"];
                                 $n = $row["descricao"];
                                 $cp = $row["valor"];
                                 $qtd = $row["quantidade"];
                                 $data = $row["data"];                    
                                 
                                 echo '<tbody>';
                                 echo '<tr>';
                                 
                                 echo '<td>'.  $id . '</td>';
                                 echo '<td>'.  $n . '</td>';
                                 echo '<td>'.  $n . '</td>';
                                 echo '<td>'.  $n . '</td>';
                                 echo '<td>'.  $n . '</td>';
                                 }
 
                                 echo '</tr>
                                 </tbody>
                                 </table>
                                 </div> ';                        
                         # code...
                     }





                    public function list(): void
                    {   
                        $sql = 'select * from usuario_adm';
                        echo '<h3>Produtos</h3>';          
                        foreach ($this->conexao->query($sql) as $key => $value) {
                        
                        echo 'id: ' .$value['id_usuario_adm'] . '<br> Descrição: ' . $value['nome'] . '<br> Valor: ' . $value['email'] . '<br> Quantidade: ' . $value['senha'] . '<hr>';     
                        }    
                    }

                    public function insert(): int
                    

                    {           
                        
                        $sql = 'insert into cadastro (plano, plano1) values (?, ?)';

                        $prepare = $this->conexao-> prepare ($sql);                        
                       // $data_atual = date ("Y-m-d H:i:s");
                        $prepare->bindParam(1, $_GET['plano']);
                        $prepare->bindParam(2, $_GET['plano1']); 
                       // $prepare->bindParam(3, $_GET['quantidade']);
                        // $prepare->bindParam(4, $data_atual, PDO::PARAM_STR, 12);
                        
                        $prepare->execute();                        
                        return $prepare->rowCount();

                    }

                    public function update() 
                    {
          
                    }

                    public function delete() 
                    {

                    }

                }


?>