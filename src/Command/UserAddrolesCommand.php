<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Question\Question;

class UserAddrolesCommand extends Command
{
    protected static $defaultName = 'app:user:addroles';

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent ::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Promotes a user by adding a role')
            ->addArgument('email', InputArgument::REQUIRED, 'The email')
            ->addArgument('roles', InputArgument::REQUIRED, 'The new role')
            ->setHelp(implode("\n", [
                'The <info>app:user:promote</info> command add role to a user:',
                '<info>php %command.full_name% martin.gilbert@dev-fusion.com</info>',
                'This interactive shell will first ask you for a role.',
                'You can alternatively specify the role as a second argument:',
                '<info>php %command.full_name% martin.gilbert@dev-fusion.com ROLE_ADMIN</info>',
            ]))
        ;
    }


/*protected function configure()
    {
        $this
            ->setDescription('Create a user.')
            ->addArgument('firstname', InputArgument::REQUIRED, 'The firstname')
            ->addArgument('lastname', InputArgument::REQUIRED, 'The lastname')
            ->addArgument('email', InputArgument::REQUIRED, 'The email')
            ->addArgument('password', InputArgument::REQUIRED, 'The password')
            ->addOption('super-admin', null, InputOption::VALUE_NONE, 'Set the user as super admin')
            ->addOption('inactive', null, InputOption::VALUE_NONE, 'Set the user as inactive')
            ->setHelp(implode("\n", [
                'The <info>app:user:create</info> command creates a user:',
                '<info>php %command.full_name% Martin GILBERT</info>',
                'This interactive shell will ask you for an email and then a password.',
                'You can alternatively specify the email and password as the second and third arguments:',
                '<info>php %command.full_name% Martin GILBERt martin.gilbert@dev-fusion.com change_this_password</info>',
                'You can create a super admin via the super-admin flag:',
                '<info>php %command.full_name% --super-admin</info>',
                'You can create an inactive user (will not be able to log in):',
                '<info>php %command.full_name% --inactive</info>',
            ]))
        ;
    }/*

    /*protected function configure()
    {
        $this
            ->setDescription('Promotes a user by adding a role')
            ->addArgument('email', InputArgument::REQUIRED, 'The email')
            ->addArgument('role', InputArgument::REQUIRED, 'The new role')
            ->setHelp(implode("\n", [
                'The <info>app:user:promote</info> command add role to a user:',
                '<info>php %command.full_name% martin.gilbert@dev-fusion.com</info>',
                'This interactive shell will first ask you for a role.',
                'You can alternatively specify the role as a second argument:',
                '<info>php %command.full_name% martin.gilbert@dev-fusion.com ROLE_ADMIN</info>',
            ]))
        ;
    }*/

    /*protected function interact(InputInterface $input, OutputInterface $output)
    {
        $questions = [];

        if (!$input->getArgument('firstname')) {
            $question = new Question('Please enter the firstname:');
            $question->setValidator(function ($firstname) {
                if (empty($firstname)) {
                    throw new \Exception('Firstname can not be empty');
                }

                return $firstname;
            });
            $questions['firstname'] = $question;
        }

        if (!$input->getArgument('lastname')) {
            $question = new Question('Please enter the lastname:');
            $question->setValidator(function ($lastname) {
                if (empty($lastname)) {
                    throw new \Exception('Lastname can not be empty');
                }

                return $lastname;
            });
            $questions['lastname'] = $question;
        }

        if (!$input->getArgument('email')) {
            $question = new Question('Please enter an email:');
            $question->setValidator(function ($email) {
                if (empty($email)) {
                    throw new \Exception('Email can not be empty');
                }
                if ($this->userRepository->findOneByEmail($email)) {
                    throw new \Exception('Email is already used');
                }

                return $email;
            });
            $questions['email'] = $question;
        }

        if (!$input->getArgument('password')) {
            $question = new Question('Please choose a password:');
            $question->setValidator(function ($password) {
                if (empty($password)) {
                    throw new \Exception('Password can not be empty');
                }

                return $password;
            });
            $question->setHidden(true);
            $questions['password'] = $question;
        }

        foreach ($questions as $name => $question) {
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument($name, $answer);
        }
    }*/

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $roles = $input->getArgument('roles');
        
        $userRepository = $this->em->getRepository(User::class);
        $user = $userRepository->findOneByEmail($email);
        if($user){

        $user->addRoles($roles);
        $this->em->flush();
        
        $io->success('Succés');

        } else {
            $io->error('Erreur, l adresse n existe pas');
        }
        
        /*
        if ($input->getOption('inactive')) {
            $user->setEnabled(false);
        } else {
            $user->setEnabled(true);
        }
        
        if ($input->getOption('super-admin')) {
            $user->setRoles(['ROLE_SUPER_ADMIN']);
        }

        $this->em->persist($user);
        $this->em->flush();

        $io->success(sprintf('Created user with email %s.', $email));
*/
        return 0;
    }
}
