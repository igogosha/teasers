<?php
/**
 * Created by PhpStorm.
 * User: igogosha
 * Date: 01.09.16
 * Time: 15:54
 */

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckFtpCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('ftp:check')
            ->setDescription('Check fpr changes made via ftp')
            ->setHelp("This command is run by cronjob to check for new or updated files in directory");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        /* opens a connection to the FAM service daemon */
        $fam_res = fam_open ();

        /* The second argument is the full pathname of the directory to monitor. */
        $nres = fam_monitor_directory ( $fam_res, '/home/igogosha/projects/teasers/www/uploads/');

        while( fam_pending ( $fam_res ) ) {
            $arr = (fam_next_event($fam_res)) ;
//            if ($arr['code']) == FAMCreated ) {
//                /* deal here with the new file, which name now is stored in $arr['filename'] */
//            }
            echo '<pre>';
            print_r($arr);
            exit;
}

        fam_close($fam_res);


        $output->writeln(true);
    }

}