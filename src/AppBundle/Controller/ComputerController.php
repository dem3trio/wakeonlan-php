<?php
/**
 * Created by PhpStorm.
 * User: demetrio
 * Date: 18/01/16
 * Time: 20:57
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Computer;
use Dem3trio\NetUtilsBundle\Service\NetUtils;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ComputerController extends CRUDController
{
    public function wakeUpAction($id)
    {
        /** @var Computer $object */
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $netUtils = $this->container->get('dem3trio_net_utils.service.net_utils');

        $magicPacket = $netUtils->wakeUp($object->getMac(), $object->getBroadcastIp(), $object->getPort());

        return new JsonResponse(array('status' => $magicPacket));
    }

    public function pingAction($id)
    {
        /** @var Computer $object */
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $netUtils = $this->container->get('dem3trio_net_utils.service.net_utils');
        $alive = ($netUtils->ping($object->getPingIp()) == NetUtils::PING_ALIVE);

        return new JsonResponse(array('alive' => $alive));
    }
}