<?php
    class Postagem
    {
        public static function selecionaTodos()
        {
            $con = Connection::getConn();

            $sql = "SELECT * FROM postagem ORDER BY id DESC";
            $sql = $con->prepare($sql);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('Postagem'))
            {
                $resultado[] = $row;
            }

            if (!$resultado)
            {
                throw new Exception("Não foi encontrado nenhum registro no banco");
            }

            return $resultado;
        }

        public static function selecionaPostPorId($idPost)
        {
            $con = Connection::getConn();

            $sql = "SELECT * FROM postagem WHERE id = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetchObject('Postagem');

            if (!$resultado)
            {
                throw new Exception("Não foi encontrado nenhum registro no banco");
            } else {
                // criando atributo comentarios que vai armazenar um array com os comentários relacionados ao id dessa postagem
                $resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
            }

            return $resultado;
        }

        public static function insert($dadosPost)
        {
            if (empty($dadosPost['titulo']) OR empty($dadosPost['conteudo']))
            {
                throw new Exception("Preencha todos os campos");

                return false;
            }

            $con = Connection::getConn();

            $sql = $con->prepare('INSERT INTO postagem (titulo, conteudo) VALUES (:title, :content)');
            $sql->bindValue(':title', $dadosPost['titulo']);
            $sql->bindValue(':content', $dadosPost['conteudo']);
            $res = $sql->execute();

            if ($res == 0) {
                throw new Exception("Falha ao inserir pulicação!");

                return false;
            }

            return true;
        }

        public static function update($dadosPost)
        {
            if (empty($dadosPost['titulo']) OR empty($dadosPost['conteudo']))
            {
                throw new Exception("Preencha todos os campos");

                return false;
            }

            $con = Connection::getConn();

            $sql = "UPDATE `postagem` SET `titulo` = :title, `conteudo` = :content WHERE `postagem`.`id` = :ident";
            $sql = $con->prepare($sql);
            $sql->bindValue(':ident', $dadosPost['id']);
            $sql->bindValue(':title', $dadosPost['titulo']);
            $sql->bindValue(':content', $dadosPost['conteudo']);
            $res = $sql->execute();

            if ($res == 0) {
                throw new Exception("Falha ao atualizar pulicação!");

                return false;
            }

            return true;
        }

        public static function deletar($idPost)
        {
            $con = Connection::getConn();
            $sql = "DELETE FROM postagem WHERE id = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();
        }
    }

?>