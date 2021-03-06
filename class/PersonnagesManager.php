<?php

class PersonnagesManager
{
  private $db; // Instance de PDO
  
  public function __construct($db)
  {
    $this->setDb($db);
  }
  
  public function add(Personnage $perso)
  {
    $q = $this->db->prepare('INSERT INTO personnages(nom ) VALUES(:nom )');
    $q->bindValue(':nom', $perso->nom());
    
    $q->execute();
    
    $perso->hydrate([
      'id' => $this->db->lastInsertId(),
      'degats' => 0,
    ]);
  }
  
  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM personnages')->fetchColumn();
  }
  
  public function delete(Personnage $perso)
  {
    $this->db->exec('DELETE FROM personnages WHERE id = '.$perso->id());
  }
  
  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
    {
      return (bool) $this->db->query('SELECT COUNT(*) FROM personnages WHERE id = '.$info)->fetchColumn();
    }
    
    // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
    
    $q = $this->db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
    $q->execute([':nom' => $info]);
    
    return (bool) $q->fetchColumn();
  }
  
  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->db->query('SELECT id, nom, degats type FROM personnages WHERE id = '.$info);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);

      switch ($donnees['type'])
      {
        case 'Guerrier': return new Guerrier($donnees); 
          break;
        case 'Magicien': return new Magicien($donnees); 
          break;
        case 'Archer': return new Archer($donnees); 
          break;
      }

    }
    else
    {
      $q = $this->db->prepare('SELECT id, nom, degats type FROM personnages WHERE nom = :nom');
      $q->execute([':nom' => $info]);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);

      switch ($donnees['type'])
      {
        case 'Guerrier': return new Guerrier($donnees); break;
        case 'Magicien': return new Magicien($donnees); break;
        case 'Archer': return new Archer($donnees); break;
      }

    }
  }
  
  public function getList($nom)
  {

    $persos = [];

    $q = $this->db->prepare('SELECT id, nom, degats type FROM personnages WHERE nom <> :nom ORDER BY nom');
    $q->execute([':nom' => $nom]);
    $donnees = $q->fetchAll(PDO::FETCH_ASSOC);
    foreach ($donnees as $donnee) {

      switch ($donnee['type'])
      {
        case 'Guerrier': array_push ($persos, new Guerrier($donnee)); break;
        case 'Magicien': array_push ($persos, new Magicien($donnee)); break;
        case 'Archer':array_push ($persos, new Archer($donnee)); break;
      }
    }

    return $persos;

  }
  public function update(Personnage $perso)
  {
    if($perso->experience() >= 100){
      $perso->setExperience(0);
      $perso->setNiveau(1);
      $perso->setStrength($perso->niveau());
    }
    $q = $this->db->prepare('UPDATE personnages SET degats = :degats WHERE id = :id');
    

    $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
    

    $q->execute();
  }
  
  public function setDb(PDO $db)
  {
    $this->db = $db;
  }
}