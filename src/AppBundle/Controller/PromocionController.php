<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DatosDapda;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;

class PromocionController extends Controller
{
    /**
     * @Route("/promocion", name="landing")
     */
    public function indexAction(Request $request)
    {   
        $clase = 'form-control';
        $preferencia = $request->query->get("preferencia");
        if ($preferencia!="tarde" && $preferencia!="noche") $preferencia = "mañana";     
        $datos = new DatosDapda();
        $form = $this->createFormBuilder($datos)
            ->add('nombre',TextType::class, array('required'=> true,'attr'=>array('class'=>$clase)))
            ->add('apellidos',TextType::class, array('required'=> true,'attr'=>array('class'=>$clase)))
            ->add('telefono',TextType::class, array(
                'required'=> false,
                'attr'=>array(  'class'=>$clase,
                                'minlength'=>'9',
                                'maxlength'=>'9',
                                'pattern'=>'(6|7|9)[0-9]*',
                ),
            ))
            ->add('email',EmailType::class, array('required'=> true,'attr'=>array('class'=>$clase)))
            ->add('tipo',ChoiceType::class, array(
                'required' => true,
                'attr'=>array('class'=>$clase),
                'choices' => array('turismo'=>'turismo','todo terreno'=>'todoterreno','comercial'=>'comercial'),
            ))
            ->add('vehiculo',ChoiceType::class, array(
                'required' => true,
                'attr'=>array('class'=>$clase),
                'choices' => array('corsa'=>'corsa','astra'=>'astra'),
            ))
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $user = $event->getData();
                $informe = $event->getForm();

                if ($user['tipo']=="todoterreno") {
                    $informe->add('vehiculo',ChoiceType::class, array(
                        'required' => true,
                        'attr'=>array('class'=>'form-control'),
                        'choices' => array('mokka'=>'mokka','crossland'=>'crossland'),
                    ));
                } else {
                    $informe->add('vehiculo',ChoiceType::class, array(
                        'required' => true,
                        'attr'=>array('class'=>'form-control'),
                        'choices' => array('corsa'=>'corsa','astra'=>'astra'),
                    ));                    
                }
            })
            ->add('preferencia',ChoiceType::class, array(
                'required' => true,
                'attr'=>array('class'=>'form-control'),
                'choices' => array(
                    'mañana'=>'mañana',
                    'tarde'=>'tarde',
                    'noche'=>'noche',
                ),
                'data' => $preferencia,
            ))
            ->add('enviar',SubmitType::class, array('attr'=>array('class'=>'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $nombre = $form['nombre']->getData();
            $apellidos = $form['apellidos']->getData();
            $telefono = $form['telefono']->getData();
            $email = $form['email']->getData();
            $tipo = $form['tipo']->getData();
            $vehiculo = $form['vehiculo']->getData();
            $preferencia = $form['preferencia']->getData();
            
            $datos->setNombre("$nombre");
            $datos->setApellidos("$apellidos");
            $datos->setTelefono("$telefono");
            $datos->setEmail("$email");
            $datos->setTipo("$tipo");
            $datos->setVehiculo("$vehiculo");
            $datos->setPreferencia("$preferencia");

            $em = $this->getDoctrine()->getManager();
            $em->persist($datos);
            $em->flush();

            $this->sendEmail($email);
            
            $this->addFlash(
                'exito',
                'Tus cambios se han guardado con exito'
            );

            return $this->redirectToRoute("gracias");
        }

        return $this->render('promo/index.html.twig', array('form' => $form->createView() ));
    }

    private function sendEmail($correo) {
        $message = (new \Swift_Message('Gracias por su visita'))
            ->setFrom('david@lopez.com')
            ->setTo($correo)
            ->setBody('Le agradecemos su visita y estaremos a su disposicion para cualquier cosa que necesite.','text/html');
        
        $this->get('mailer')->send($message);        
    }

     /**
     * @Route("/gracias-promocion", name="gracias")
     */
    public function thanksAction(Request $request) {
        $flashbag = $this->get('session')->getFlashBag();
        $ver=$flashbag->get("exito");
        if (count($ver)) {
            return $this->render('promo/thanks.html.twig');
        } else {
            return $this->redirectToRoute("landing");
        }       
    }
}
