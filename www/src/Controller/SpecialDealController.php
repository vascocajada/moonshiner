<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\ProductRepository;
use App\Repository\CartRepository;
use App\Repository\MemberRepository;
use App\Repository\OrderPaidRepository;
use App\Repository\OrderDetailRepository;

use App\Entity\Cart;
use App\Entity\OrderPaid;
use App\Entity\OrderDetail;

class SpecialDealController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function login(Request $request, MemberRepository $memberRepository): Response
    {

        if ($idMember = $request->get('emulate-member')) {
            return $this->redirectToRoute('special_deal', ['idMember' => $idMember]);
        }

        $members = $memberRepository->findAll();

        return $this->render('index.html.twig', [
            'members' => $members,
        ]);
    }

    /**
     * @Route("/special-deal/{idMember}", name="special_deal")
     */
    public function specialDeal(
        Request $request,
        ProductRepository $productRepository,
        CartRepository $cartRepository,
        MemberRepository $memberRepository,
        $idMember
    ): Response
    {
        $member = $memberRepository->find($idMember);

        if (!$member) {
            throw $this->createNotFoundException(
                'No member found for id '.$id
            );
        }

        $products = $productRepository->findAll();
        $carts = $member->getCarts();

        $total = $memberRepository->getCartTotal($idMember);

        return $this->render('special_deal.html.twig', [
            'products' => $products,
            'carts' => $carts,
            'member' => $member,
            'total' => $total
        ]);
    }

    /**
     * @Route("/add-product/{idMember}", name="add_product", methods={"POST"})
     */
    public function addProduct(Request $request, ProductRepository $productRepository, MemberRepository $memberRepository, EntityManagerInterface $entityManager, $idMember)
    {
        $member = $memberRepository->find($idMember);

        if (!$member) {
            throw $this->createNotFoundException(
                'No member found for id '.$id
            );
        }

        if ($idProduct = $request->get('add-product')) {
            $product = $productRepository->find($idProduct);

            $cart = new Cart();
            $cart->setMember($member);
            $cart->setProduct($product);

            $entityManager->persist($cart);
            $entityManager->flush();

        }
        return $this->redirectToRoute('special_deal', ['idMember' => $idMember]);
    }

    /**
     * @Route("/checkout/{idMember}", name="checkout", methods={"POST"})
     */
    public function checkout(
        Request $request,
        ProductRepository $productRepository,
        MemberRepository $memberRepository,
        OrderPaidRepository $orderPaidRepository,
        OrderDetailRepository $orderDetailRepository,
        EntityManagerInterface $entityManager,
        $idMember
    )
    {
        $member = $memberRepository->find($idMember);
        
        if (!$member) {
            throw $this->createNotFoundException(
                'No member found for id '.$id
            );
        }

        $voucherCode = $request->get('voucher-code');
        $carts = $member->getCarts();

        if (!$carts->count()) {
            return $this->redirectToRoute('index');
        }

        $total = $memberRepository->getCartTotal($idMember);

        $prettyCarts = $this->prettifyCarts($carts);

        $orderPaidsCount = $member->getOrderPaids()->count();

        $total = \DealRules::checkA($carts->count(), $orderPaidsCount, $total);
        $total = \DealRules::checkB($prettyCarts, $total);
        $newVoucherCode = \DealRules::checkC($orderPaidsCount);
        $total = \DealRules::checkD($voucherCode, $total);
        $total = \DealRules::checkE($prettyCarts, $total);


        $orderPaid = new OrderPaid();
        $orderPaid->setMember($member);
        $orderPaid->setTotal($total);

        $entityManager->persist($orderPaid);
        $entityManager->flush();

        foreach($carts as $cart) {
            $product = $cart->getProduct();

            $orderDetail = new OrderDetail();
            $orderDetail->setOrderPaid($orderPaid);
            $orderDetail->setProduct($cart->getProduct());

            $entityManager->persist($orderDetail);
        }
        $entityManager->flush();

        $orderDetails = $orderDetailRepository->findByOrderPaidId($orderPaid->getId());

        $total = $memberRepository->emptyCart($idMember);

        return $this->render('checkout.html.twig', [
            'orderPaid' => $orderPaid,
            'orderDetails' => $orderDetails,
            'newVoucherCode' => $newVoucherCode
        ]);
    }

    private function prettifyCarts($carts)
    {
        $prettyCarts = [];

        foreach($carts as $cart) {
            $prettyCarts[] = [
                'product_price' => $cart->getProduct()->getPrice(),
                'product_id' => $cart->getProduct()->getId()
            ];
        }

        return $prettyCarts;
    }
}
