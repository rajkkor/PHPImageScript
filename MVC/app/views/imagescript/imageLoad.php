<?php
//echo "Image load";
class imageLoad
{
    private $file;
    private $type;
    private $height, $width;

    public function launch($file = "", $w, $h)
    {
        //print_r(getimagesize($file));
        $this->height = getimagesize($file)[1];
        $this->width = getimagesize($file)[0];
        //$this->save("tmp.png");
        $this->getType($file);
        $this->output($w, $h);
    }

    private function getType($file)
    {
        $type = explode("/", getimagesize($file)['mime']);
        switch ($type[count($type) - 1]) {
            case "png":
                $this->type = "png";
                header('Content-Type: image/png');
                $this->setFile($file);
                break;
            case "jpeg" || "jpg":
                $this->type = "jpeg";
                header('Content-Type: image/jpeg');
                $this->setFile($file);
                break;
            case "gif":
                $this->type = "gif";
                header('Content-Type: image/gif');
                $this->setFile($file);
                break;
            default:
                $this->type = "none";
                break;
        }
    }


    private function setFile($file)
    {
        $this->file = $file;
    }


    private function output($w = null, $h = null)
    {
        //check if they are set or not,otherwise they will return to its origin
        if ($w === null && $h === null) {
            $w = $this->width;
            $h = $this->height;
        }
        $pw = $w;
        $ph = $h;

        $rw = $w / $this->width; //ratioWidth
        $rh = $h / $this->height;//ratioHeight

        //creating scaling ratio
        if ($rw < $rh) {
            $w = $this->width * $rh;


        } else if ($rh < $rw) {
            $h = $this->height * $rw;

        } else {
            //do nothing
        }

        // Create image instances
        switch ($this->type) {
            case "jpeg" || "jpg":
                $src = imagecreatefromjpeg($this->file);
                break;
            case "png":
                $src = imagecreatefrompng($this->file);
                break;
            case "gif":
                $src = imagecreatefromgif($this->file);
                break;
        }

        $dest = imagecreatetruecolor($pw, $ph);

        //resizing
        imagecopyresized($dest, $src, 0, 0, 0, 0, $w, $h, $this->width, $this->height);

        //Output
        switch ($this->type) {
            case "jpeg" || "jpg":
                imagejpeg($dest);
                break;
            case "png":
                imagepng($dest);
                break;
            case "gif":
                imagegif($dest);
                break;
        }

        imagedestroy($dest);
        imagedestroy($src);
    }

    public function save($name)
    {
        $image = new Imagick($this->file);
        /* some processing */

        // or
        unlink($this->file);
        $image->writeImage($this->file);
        file_put_contents($name, $image);
    }
}