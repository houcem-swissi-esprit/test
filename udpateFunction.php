namespace App\Controller;

use App\Entity\Student;
use App\Entity\Classroom;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route


class StudentController extends AbstractController
{
    /**
     * @Route("/chatroom/{NSC}/edit", name="Student_edit")
     */
    public function edit(Student $Student, Request $request)
    {
        $form = $this->createForm(StudentType::class, $Student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Student mis à jour avec réussite');

            return $this->redirectToRoute('read');
        }

        return $this->render('chatroom/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }
}
