<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Pipeline\Pipeline;

use function PHPUnit\Framework\matchesRegularExpression;

class InstallImagick extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:imagick {--url=} {--revert}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }
    protected $imagick_link = "https://windows.php.net/downloads/pecl/releases/imagick/3.7.0/php_imagick-3.7.0-8.1-ts-vs16-x64.zip";
    private $extension_string = "\r\n".
                        "[Imagick]\r\n".
                        ";Imagick extension, automatically installed by php artisan install:imagick\r\n".
                        "extension=php_imagick.dll\r";
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('revert')) {
            $this->reverse();
            $this->info('Successfully reversed');
            return 0;
        }
        
        if (extension_loaded('imagick')) {
            $this->info('Imagick already installed');
            return 0;
        }

        $url = $this->option('url');
        if ($url) {
            if (!preg_match('/(.+).zip/', $url)) {
                $this->error('Custom download link must be a direct link to a .zip file');
                return 1;
            }
            $this->imagick_link = $url;
        }



        $this->setup();



        try {
        
            $this->downloadImagick();
            $this->unpackImagickZip();
            $this->moveFilesToPHP();
            $this->writePHPIni();
            $this->clearTempFiles(); 
            return $this->done();

        } catch (\Throwable $th) {
            $this->reverse();
            $this->error($th->getMessage());
            return 1;
        }
    }


    private function setup(){
        $this->output->title('Installing Imagick');
        $this->bar = $this->output->createProgressBar(5);
        $this->bar->setFormat("%current%/%max% [%bar%] %message%");
        $this->bar->start();

    }

    private function downloadImagick(){
        $this->nextStep('Downloading Imagick');

        $opts = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"User-Agent: Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36"
            )
        );
        $this->temp_zip_path = $this->temp_dir('imagick.zip');

        try {
            if(file_exists($this->temp_zip_path)){
                $zip_content = file_get_contents($this->temp_zip_path);
            }else{
                $zip_content = file_get_contents($this->imagick_link, false, stream_context_create($opts));
                file_put_contents($this->temp_zip_path, $zip_content);
            };
        } catch (\Throwable $th) {
            throw new \Exception("Error error downloading Imagick. " .$th->getMessage() ,previous: $th);
        }

    }

    private function unpackImagickZip(){
        $this->nextStep('Unpacking Imagick');

        $zip = new \ZipArchive;

        $isOpen = $zip->open($this->temp_zip_path);

        if(!$isOpen){
            throw new \Exception('Error unpacking Imagick.'.$zip->getStatusString());
            return 1;
        }
        
        $zip->extractTo($this->temp_dir('imagick_temp'));
        $zip->close();
 
     }

     private function moveFilesToPHP(){
         $this->nextStep('Moving Files to PHP directory');
        try {

            
            if (!file_exists($this->temp_dir('imagick_temp/php_imagick.dll')) and file_exists($this->temp_dir('imagick_temp'))) {
                # code...
            }
            $this->all_files = [];
            foreach (glob($this->temp_dir('imagick_temp/*')) as $file) {
                array_push($this->all_files, pathinfo($file, PATHINFO_BASENAME));
            }


            rename( $this->temp_dir('imagick_temp/php_imagick.dll'), 
                    $this->extension_dir('php_imagick.dll'));
            
            $files = glob($this->temp_dir('imagick_temp/*'));
    
    
            foreach ($files as $file) {
                $basename = pathinfo($file, PATHINFO_BASENAME);
                if (in_array($basename, ['tests','exemples'])) {
                    continue;
                }
                rename( $file, 
                        $this->php_dir($basename));
            }    
        } catch (\Throwable $th) {
            throw new \Exception("Error moving files to PHP directory.".$th->getMessage() ,previous: $th);
        }
     }


    private function writePHPIni(){
       $this->nextStep('Writing PHPIni');
       try {
           $ini = fopen($this->php_dir('php.ini'), 'a');
    
           fwrite($ini, $this->extension_string);

           fclose($ini);

       } catch (\Throwable $th) {
           throw new \Exception("Error writing to PHP ini. ".$th->getMessage() ,previous:$th);
       }
    } 

    private function clearTempFiles(){
        $this->nextStep('Cleaning Up temporary files');
        $imagick_dir = $this->temp_dir('imagick_temp');
        $imagick_zip = $this->temp_dir('imagick.zip');

        $this->deleteDirRecursive($imagick_dir);

        if (is_file($imagick_zip)) {
            unlink($imagick_zip);
        }
    }

    private function deleteDirRecursive($dir_path){
        $files = glob($dir_path.DIRECTORY_SEPARATOR.'*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
                continue;
            }
            $this->deleteDirRecursive($file);
        }
        rmdir($dir_path);
    }

    private function done(){
        $this->bar->finish();
        $this->newLine(2);
        $this->info('Imagick installed successfully');
        $this->warn('Reset your server to apply the changes');
        return 0;
    }

    private function reverse(){
        $php_files = glob($this->php_dir('*'));

        $this->all_files = [];
        $files = glob($this->temp_dir('imagick_temp/*'));
        foreach ($files as $file) {
            $basename = $this->php_dir(pathinfo($file, PATHINFO_BASENAME));
            array_push($this->all_files, $basename);
        }
        
        $imagick_files = array_intersect($php_files, $this->all_files);

        foreach ($imagick_files as $file) {
            try {
                if (is_file($file)) {
                    unlink($file);
                    continue;
                }
                $basename = pathinfo($file, PATHINFO_BASENAME);
                if (in_array($basename, ['exemples', 'tests'])) {
                    continue;
                }
                foreach (glob($file.DIRECTORY_SEPARATOR."*") as $file_inside_directory) {
                    unlink($file_inside_directory);
                }
                rmdir($file);
            } catch (\Throwable $th) {
                $this->warn('File could not be deleted : '. $file."\n".$th->getMessage());
                continue;
            }
        }
        
        $imagick_dll_file = $this->extension_dir('php_imagick.dll');
        if (file_exists($imagick_dll_file)) {
            unlink($imagick_dll_file);
        }
        $ini_file = explode("\n", file_get_contents($this->php_dir('php.ini')));
        $extension_string = explode("\n", $this->extension_string);
        
        if (array_intersect($extension_string, $ini_file) > count($extension_string)) {
            $ini_file = explode("\n", file_get_contents($this->php_dir('php.ini')));

            $extension_string = explode("\n", $this->extension_string);
            $extension_string = array_filter($extension_string, function($line){
                return !in_array($line,["\r",""," "]);
            });

            $ini = join("\n",array_diff($ini_file, $extension_string));
            file_put_contents($this->php_dir('php.ini'), $ini);
        }

    }

    private function nextStep($title){
        $this->bar->setMessage($title);
        $this->bar->advance();
    }

    private function php_dir($path = ''){
        return dirname(php_ini_loaded_file()).DIRECTORY_SEPARATOR.$path;
    }

    private function extension_dir($path = ''){
        return ini_get('extension_dir').DIRECTORY_SEPARATOR.$path;
    }

    private function temp_dir($path = ''){
        return sys_get_temp_dir().DIRECTORY_SEPARATOR.$path;
    }
}
