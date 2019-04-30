<?php

namespace App\Twig\Extension;

use App\Repository\CompanyRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MenuCompanyExtension extends AbstractExtension
{
    /** @var CompanyRepository */
    protected $companyRepo;
    /** @var UrlGeneratorInterface */
    protected $urlGenerator;

    /**
     * MenuCompanyExtension constructor.
     * @param CompanyRepository $companyRepo
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(CompanyRepository $companyRepo, UrlGeneratorInterface $urlGenerator)
    {
        $this->companyRepo = $companyRepo;
        $this->urlGenerator = $urlGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('menuCompany', [$this, 'menuCompany'], ['is_safe' => ['html']]),
        ];
    }

    public function menuCompany()
    {
        $html = '';

        foreach ($this->companyRepo->findAllWithAtLeastOneContact() as $company) {
            $html .= '<a class="dropdown-item" href="'.$this->urlGenerator->generate('company_show', ['id' => $company->getId()]).'">'.$company->getName().'</a>';
        }

        return $html;
    }
}
