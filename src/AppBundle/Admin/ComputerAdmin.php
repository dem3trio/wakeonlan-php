<?php
/**
 * Created by PhpStorm.
 * User: demetrio
 * Date: 18/01/16
 * Time: 20:28
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Sonata\AdminBundle\Show\ShowMapper;

class ComputerAdmin extends Admin
{
    protected $translationDomain = 'SonataAdminBundle';

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Computer Info')
                ->add('name',         TextType::class, array( "required" => true, "label" => "field.name"))
                ->add('mac',          TextType::class, array( "required" => true, "label" => "field.mac"))
                ->add('port',         NumberType::class, array( "required" => true, "label" => "field.port"))
                ->add('broadcast_ip', TextType::class, array( "required" => true, "label" => "field.broadcast_ip"))
                ->add('ping_ip',      TextType::class, array( "required" => false, "label" => "field.ping_ip"))
                ->add('ping_port',    NumberType::class , array( "required" => false, "label" => "field.ping_port"))
            ->end()
        ;

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('name',         null, array( "label" => "field.name"))
            ->add('mac',          null, array( "label" => "field.mac"))
            ->add('ping_ip',      null, array( "label" => "field.ping_ip"))
            ->add('awake',        'string', array(
                "label" => "field.is_awake",
                'template' => 'AppBundle:Ping:list_custom.html.twig'
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'wakeUp' => array(
                        'template' => 'AppBundle:WakeUp:wakeup__action_clone.html.twig'
                    ),
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('wakeUp', $this->getRouterIdParameter().'/wake-up');
        $collection->add('ping', $this->getRouterIdParameter().'/ping');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name');
    }

    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->with('Computer Info')
            ->add('name',         null, array( "label" => "field.name" ))
            ->add('mac',          null, array( "label" => "field.mac" ))
            ->add('port',         null, array( "label" => "field.port" ))
            ->add('broadcast_ip', null, array( "label" => "field.broadcast_ip" ))
            ->add('ping_ip',      null, array( "label" => "field.ping_ip" ))
            ->add('ping_port',    null, array( "label" => "field.ping_port" ))
            ->end()
        ;
    }

}