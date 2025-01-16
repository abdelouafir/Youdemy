<?php 
namespace app\Models;
use pdo;
use PDOException;
abstract class Course {
    protected string $title;
    protected string $description;
    protected string $content;
    protected string $photo;
    protected string $status;
    protected float $prix;
    protected string $niveau;
    protected string $enseignant;
    protected string $student;
    protected $category;
    // protected string $teacher_id;

    
    public function __construct($title,$descreption,$countent,$photo,$status,$niveau,$enseignant,$category)
    {
        $this->title = $title;
        $this->enseignant = $enseignant;
        $this->description = $descreption;
        $this->content = $countent;
        $this->photo = $photo;
        $this->status = $status;
        // $this->prix = $prix;
        $this->niveau = $niveau;
        $this->category = $category;
    }

    abstract public function add_cours($pdo);
}
?>
