<?php
namespace Menu;

/**
 * @author Diodio MBODJ
 */
use Be\BaseEntite as BaseEntite;
/** @Entity @HasLifecycleCallbacks
 * @Table(name="ud_menu",uniqueConstraints={@UniqueConstraint(columns={"name", "user_id"})}) * */

class Menu extends  BaseEntite
{
    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    private $id;
    /**
     * @Column(type="date", length=200,nullable=true)
     * */
    private $date;
     /**
     * @Column(type="string", length=200,nullable=false)
     * */
    private $name;
    /**
     * @Column(type="string", length=200,nullable=false)
     * */
    private $text;
    /**
     * @Column(type="string", length=200,nullable=true)
     * */
    private $title;
    /**
     * @Column(type="string", length=200,nullable=true)
     * */
    private $type;
    /**
    * @Column(type="integer")
    * */
    private $ordre;
    /**
     * @Column(type="integer", options={"default":0})
     * */
    private $etape;
    /**
     * @Column(type="string", length=200,nullable=true)
     * */
    private $action;
    
    /**
     * @Column(type="string", length=200,nullable=true)
     * */
    private $methode;
    
    /**
     * @Column(type="string", length=200,nullable=true)
     * */
    private $url;
    /**
     * @Column(type="integer", options={"default":1})
     */
    protected $generate;
//     /**
//      * @Column(type="integer")
//      * */
//     private $sequence;
    
     /** @ManyToOne(targetEntity="User\User",cascade={"persist"}) */
    private $user;
    /** @ManyToOne(targetEntity="Menu\Menu",cascade={"persist"}) */
    private $parent;
    
    
    
    /**
     * @return mixed
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * @param mixed $etape
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;
    }

    /**
     * @return mixed
     */
    public function getGenerate()
    {
        return $this->generate;
    }

    /**
     * @param mixed $generate
     */
    public function setGenerate($generate)
    {
        $this->generate = $generate;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getMethode()
    {
        return $this->methode;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

//     /**
//      * @return mixed
//      */
//     public function getSequence()
//     {
//         return $this->sequence;
//     }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param mixed $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @param mixed $methode
     */
    public function setMethode($methode)
    {
        $this->methode = $methode;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

//     /**
//      * @param mixed $sequence
//      */
//     public function setSequence($sequence)
//     {
//         $this->sequence = $sequence;
//     }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    function getOrdre() {
        return $this->ordre;
    }

    function setOrdre($ordre) {
        $this->ordre = $ordre;
    }


}

