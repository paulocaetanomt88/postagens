<?php

    class Comentario
    {
        public static function selecionarComentarios($idPost)
        {
            $con  = Connection::getConn();

            $sql = "SELECT * FROM comentario WHERE id_postagem = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('Comentario'))
            {
                $resultado[] = $row;
            }

            return $resultado;
        }

        public static function inserir($reqPost)
        {
            $con  = Connection::getConn();

            $sql = "INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:name, :message, :id_post)";
            $sql = $con->prepare($sql);
            $sql->bindValue(':name', $reqPost['nome']);
            $sql->bindValue(':message', $reqPost['msg']);
            $sql->bindValue(':id_post', $reqPost['id']);
            $sql->execute();

            // se conseguir fazer a inserção retorna verdadeiro
            if ($sql->rowCount()) {
                return true;
            }

            // se não conseguir fazer a inserção lança um erro
            throw new Exception("Falha na inserção");
        }
        
    }

?>