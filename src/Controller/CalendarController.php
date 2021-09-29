<?php
    namespace App\Controller;

    use App\Entity\ThisYear;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Components\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class CalendarController extends AbstractController {
        /**
         * @Route("/", name="home")
         * @Method({"GET"})
         */
        /*This function find events on current day and make an array with months names. 
        It also render main page of calendar*/ 
        public function index() {
            
            $day = date('j');
            $month = date('F');

            $events = $this->getDoctrine()->getRepository(ThisYear::class)
            ->findEvents($month, $day);

            $i = 2;
           while ($i < 14) {
            $months[]= date('F', mktime(0,0,0,$i,0,0));
            $i++;
           }
            return $this->render("/calendar/index.html.twig",[
                'months' => $months,
                'events' => $events
            ]);
        }
        /**
         * @Route("/{id}", name="month")
         * @Method({"GET"})
         */
        /*this function create an array with number of days in selected month, then count events 
        for each day and finds the name of every day. It render a calendar page of selected month*/
         public function calendar($id) {
            
            $i = 2;
             while ($i < 14) {
                $months[]= date('F', mktime(0,0,0,$i,0,2021));
                $i++;
                }
            $id += 1;
            $days = cal_days_in_month(CAL_GREGORIAN, $id, 2021);
            $id += 1;
            $month_name = date('F', mktime(0,0,0,$id,0,2021));
            $id -= 1;
            $d = 1;
            while ($d <= $days){
                $count_events[] = $this->getDoctrine()->getRepository(ThisYear::class)
                ->countEvents($month_name, $d);
                $day[] = date('D', mktime(0,0,0,$id,$d,2021));
                $d++;
            }

            $full_day = array_map(null, $count_events, $day);
            
            return $this->render("/calendar/month.html.twig",[
                'months' => $months,
                'month' => $month_name,
                'monthnumber' => $id,
                'full' => $full_day
            ]);

         }
         /**
         * @Route("/{month}/{id}", name="list")
         * @Method({"GET", "POST"})
         */
        /*This function find events for selected day and create form to add new event. */
         public function input($month, $id, Request $request){

            $events = $this->getDoctrine()->getRepository(ThisYear::class)
            ->findEvents($month, $id);
            
            $calendar = new ThisYear();

            $calendar->setMonth($month);
            $calendar->setUserId(1);
            $calendar->setDay($id);

            $form = $this->createFormBuilder($calendar)
            ->add('hour', TextType::class, array('attr' 
            =>array('class' => 'form-control',
                    'pattern' => '/^[0-9]{8}{:}$/')))
            ->add('event', TextareaType::class, array('attr'
            =>array('class' => 'form-control'
                    , 'maxlength' => 100)))
            ->add('save', SubmitType::class, array(
            'label' => 'Create',
            'attr' =>array('class' => 'btn btn-primary my-3')))
            ->getForm();

            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){

                $entityManeger = $this->getDoctrine()->getManager();
                $entityManeger->persist($calendar);
                $entityManeger->flush();

                return $this->redirectToRoute('home');
            }

            return $this->render("/calendar/day_events.html.twig", array(
                'form' => $form->createView(),
                'events' => $events,
                'month' => $month,
                'day' => $id
            )); 
         }
         /**
         * @Route("/{month}/{id}/{event}", name="delete")
         * @Method({"DELETE"})
         */
        //this function delete selected event
        public function delete($month, $id, $event){
            $delete = $this->getDoctrine()->getRepository(ThisYear::class)->deleteEvents($month, $id, $event);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($delete[0]);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
    }