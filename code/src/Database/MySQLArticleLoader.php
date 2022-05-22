<?php

namespace Returnnull;

class MySQLArticleLoader
{
    public function __construct(
        private MySQLConnector $mySQLConnector
    ){}

    public function get($articleID = LAST_ARTICLE_ID): array
    {
        if ($articleID == LAST_ARTICLE_ID){
            $articleID = $this->getLastArticleID();
         }

        $result = $this->fetchArticle($articleID);

        if(!empty($result)){
            return $result[0];
        } else { //wenn kein artikel, dann gib mir wenigstens den letzten Artikel
            return $this->fetchArticle($this->getLastArticleID())[0];
        }
    }

    private function fetchArticle($articleID){
        $sql = $this->mySQLConnector->prepare('SELECT *
                                                     FROM Articles
                                                     WHERE id = :id;');
        $sql->bindValue(':id', $articleID);
        $sql->execute();
        return $sql->fetchAll();
    }

    private function getLastArticleID(){
        $sql = $this->mySQLConnector->prepare('select MAX(id) from Articles');
        $sql->execute();
        return $sql->fetchAll()[0][0];
    }
}