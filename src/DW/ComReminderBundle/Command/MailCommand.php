<?php

namespace DW\ComReminderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MailCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('mail:send')
                ->setDescription('Envoyer un mail')
               ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $container = $this->getContainer();
        $email_sender = $container->getParameter('email_sender');
        $email_perso = $container->getParameter('email_perso');

        $message = \Swift_Message::newInstance()
                ->setSubject($this->subjectTest())
                ->setFrom($email_sender)
                ->setTo($email_perso)
//                ->setBody($this->renderView('DWComReminderBundle:Default:passwordReinit.html.twig'))
                ->addPart($this->messageTest(), 'text/html')
        ;

        $mailer = $container->get('mailer');

        // progessBar
        
        $progress = $this->getApplication()->getHelperSet()->get('progress');
        $progress->start($output, 10);
        $i = 0;
        while ($i++ < 10) {

            $mailer->send($message);
            $progress->advance();
            
        }

        $progress->finish();
    }

    protected function subjectTest() {
        return "Envoi des lignes de commandes";
    }

    protected function messageTest() {


        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $entities = $em->getRepository('DWComReminderBundle:Remind')->findAll();

        $commandes = "";

        $commandes .= "<h1>Les commandes : </h1><p>&nbsp;</p>";
        foreach ($entities as $value) {
            $commandes .= $value->getText() . "<br/>";
        }
        return $commandes;
    }

}