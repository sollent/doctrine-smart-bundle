<?php

namespace sollent\DoctrineSmartBundle\Controller;

use sollent\DoctrineSmartBundle\DTO\Entity\EntityDTO;
use sollent\DoctrineSmartBundle\EntityCreator\EntityCreatorInterface;
use sollent\DoctrineSmartBundle\Form\EntityForm;
use sollent\DoctrineSmartBundle\Repository\EntityClassRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntityCreatorController extends AbstractController
{
    private EntityClassRepositoryInterface $entityClassRepository;

    private EntityCreatorInterface $entityCreator;

    /**
     * @param EntityClassRepositoryInterface $entityClassRepository
     * @param EntityCreatorInterface $entityCreator
     */
    public function __construct(
        EntityClassRepositoryInterface $entityClassRepository,
        EntityCreatorInterface $entityCreator
    )
    {
        $this->entityClassRepository = $entityClassRepository;
        $this->entityCreator = $entityCreator;
    }

    /**
     * @Route(
     *     "/list",
     *     name="list-action"
     * )
     *
     * @return Response
     */
    public function listAction(): Response
    {
        return $this->render('list.html.twig', [
            'entities' => $this->entityClassRepository->findAll()
        ]);
    }

    /**
     * @Route(
     *     "/new",
     *     name="new-action"
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function newEntityAction(Request $request): Response
    {
        $entity = new EntityDTO();
        $form = $this->createForm(EntityForm::class, $entity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $form->getData();
            $this->entityCreator->createBasedOn($entity);
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(
     *     "/edit/{entityId}",
     *     name="edit-action"
     * )
     *
     * @param Request $request
     * @param string $entityId
     *
     * @return Response
     */
    public function editEntityAction(Request $request, string $entityId): Response
    {

    }

    /**
     * @Route(
     *     "/remove/{entityId}",
     *     name="remove-action"
     * )
     *
     * @param string $entityId
     *
     * @return Response
     */
    public function removeEntityAction(string $entityId): Response
    {

    }
}
