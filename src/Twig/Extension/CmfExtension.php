<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2017 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\CoreBundle\Twig\Extension;

use Symfony\Cmf\Bundle\CoreBundle\Templating\Helper\Cmf;
use Symfony\Cmf\Component\Routing\RouteReferrersReadInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CmfExtension extends AbstractExtension
{
    protected $helper;

    public function __construct(Cmf $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Get list of available functions.
     *
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        $functions = [
            new TwigFunction('cmf_is_published', [$this, 'isPublished']),
            new TwigFunction('cmf_child', [$this, 'getChild']),
            new TwigFunction('cmf_children', [$this, 'getChildren']),
            new TwigFunction('cmf_prev', [$this, 'getPrev']),
            new TwigFunction('cmf_next', [$this, 'getNext']),
            new TwigFunction('cmf_find', [$this, 'find']),
            new TwigFunction('cmf_find_translation', [$this, 'findTranslation']),
            new TwigFunction('cmf_find_many', [$this, 'findMany']),
            new TwigFunction('cmf_descendants', [$this, 'getDescendants']),
            new TwigFunction('cmf_nodename', [$this, 'getNodeName']),
            new TwigFunction('cmf_parent_path', [$this, 'getParentPath']),
            new TwigFunction('cmf_path', [$this, 'getPath']),
            new TwigFunction('cmf_document_locales', [$this, 'getLocalesFor']),
        ];

        if (interface_exists(RouteReferrersReadInterface::class)) {
            $functions = array_merge($functions, [
                new TwigFunction('cmf_is_linkable', [$this, 'isLinkable']),
                new TwigFunction('cmf_prev_linkable', [$this, 'getPrevLinkable']),
                new TwigFunction('cmf_next_linkable', [$this, 'getNextLinkable']),
                new TwigFunction('cmf_linkable_children', [$this, 'getLinkableChildren']),
            ]);
        }

        return $functions;
    }

    public function isPublished($document)
    {
        return $this->helper->isPublished($document);
    }

    public function isLinkable($document)
    {
        return $this->helper->isLinkable($document);
    }

    public function getChild($parent, $name)
    {
        return $this->helper->getChild($parent, $name);
    }

    public function getChildren($parent, $limit = false, $offset = false, $filter = null, $ignoreRole = false, $class = null)
    {
        return $this->helper->getChildren($parent, $limit, $offset, $filter, $ignoreRole, $class);
    }

    public function getPrev($current, $anchor = null, $depth = null, $ignoreRole = false, $class = null)
    {
        return $this->helper->getPrev($current, $anchor, $depth, $ignoreRole, $class);
    }

    public function getNext($current, $anchor = null, $depth = null, $ignoreRole = false, $class = null)
    {
        return $this->helper->getNext($current, $anchor, $depth, $ignoreRole, $class);
    }

    public function find($path)
    {
        return $this->helper->find($path);
    }

    public function findTranslation($path, $locale, $fallback = true)
    {
        return $this->helper->findTranslation($path, $locale, $fallback);
    }

    public function findMany($paths = [], $limit = false, $offset = false, $ignoreRole = false, $class = null)
    {
        return $this->helper->findMany($paths, $limit, $offset, $ignoreRole, $class);
    }

    public function getDescendants($parent, $depth = null)
    {
        return $this->helper->getDescendants($parent, $depth);
    }

    public function getNodeName($document)
    {
        return $this->helper->getNodeName($document);
    }

    public function getParentPath($document)
    {
        return $this->helper->getParentPath($document);
    }

    public function getPath($document)
    {
        return $this->helper->getPath($document);
    }

    public function getLocalesFor($document, $includeFallbacks = false)
    {
        return $this->helper->getLocalesFor($document, $includeFallbacks);
    }

    public function getPrevLinkable($current, $anchor = null, $depth = null, $ignoreRole = false)
    {
        return $this->helper->getPrevLinkable($current, $anchor, $depth, $ignoreRole);
    }

    public function getNextLinkable($current, $anchor = null, $depth = null, $ignoreRole = false)
    {
        return $this->helper->getNextLinkable($current, $anchor, $depth, $ignoreRole);
    }

    public function getLinkableChildren($parent, $limit = false, $offset = false, $filter = null, $ignoreRole = false, $class = null)
    {
        return $this->helper->getLinkableChildren($parent, $limit, $offset, $filter, $ignoreRole, $class);
    }
}
