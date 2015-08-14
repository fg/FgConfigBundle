<?php namespace Fg\Bundle\ConfigBundle\Command;

use Fg\Bundle\ConfigBundle\Service\SettingService;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class SettingCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fg:config:create')
            ->setDescription('Create a setting.')
            ->setDefinition(
                array(
                    new InputArgument('scope_group_type', InputArgument::REQUIRED, 'Scope Group Type'),
                    new InputArgument('section', InputArgument::REQUIRED, 'Scope By Id'),
                    new InputArgument('name', InputArgument::REQUIRED, 'Name'),
                    new InputArgument('value', InputArgument::REQUIRED, 'Value'),
                    new InputArgument('scope_by_id', InputArgument::OPTIONAL, 'Scope By Id'),
                )
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $scope_group_type = $input->getArgument('scope_group_type');
        $scope_by_id = intval($input->getArgument('scope_by_id'));
        $section = $input->getArgument('section');
        $name = $input->getArgument('name');
        $value = $input->getArgument('value');

        /** @var SettingService $settingService */
        $settingService = $this->getContainer()->get('fg_config.service.setting_service');
        $settingService->create($name, $value, $scope_group_type, $section, $scope_by_id);

        $output->writeln(sprintf('Created setting <comment>%s</comment>', $name));
    }


    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('scope_group_type')) {
            $scope_group_type = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose scope group type: ',
                function($scope_group_type) {
                    if (empty($scope_group_type)) {
                        throw new \Exception('Scope group type can not be empty, please use "general"');
                    }
                    return $scope_group_type;
                }
            );
            $input->setArgument('scope_group_type', $scope_group_type);
        }

        if (!$input->getArgument('scope_by_id')) {
            $scope_by_id = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Scope group id <comment>(default:0)</comment>: ',
                function($scope_by_id) {
                    return $scope_by_id;
                }
            );
            $input->setArgument('scope_by_id', $scope_by_id);
        }

        if (!$input->getArgument('section')) {
            $section = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose setting of section: ',
                function($section) {
                    if (empty($section)) {
                        throw new \Exception('Section can not be empty, please use "general"');
                    }
                    return $section;
                }
            );
            $input->setArgument('section', $section);
        }

        if (!$input->getArgument('name')) {
            $name = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose setting of name: ',
                function($name) {
                    if (empty($name)) {
                        throw new \Exception('Name can not be empty!');
                    }
                    return $name;
                }
            );
            $input->setArgument('name', $name);
        }

        if (!$input->getArgument('value')) {
            $value = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose setting of value: ',
                function($value) {
                    if (empty($value)) {
                        throw new \Exception('Value can not be empty!');
                    }
                    return $value;
                }
            );
            $input->setArgument('value', $value);
        }

    }
}