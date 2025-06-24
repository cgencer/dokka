<?php

/* profiles/opigno_lms/modules/opigno/opigno_group_manager/templates/opigno-group-manager.html.twig */
class __TwigTemplate_986dd4681d4e0076400425ceae1629b6b701d73db57d91fe4910752f5cfa683f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array();
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array(),
                array(),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 1
        echo "<!-- group/{group}}/manager -->

<base href=\"";
        // line 3
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (($context["base_path"] ?? null) . ($context["base_href"] ?? null)), "html", null, true));
        echo "\">

<script type=\"text/javascript\">
  window.appConfig = {
    formSubmitBtn: false,
    groupId: ";
        // line 8
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["group_id"] ?? null), "html", null, true));
        echo ",
    apiBaseUrl: '";
        // line 9
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["base_path"] ?? null), "html", null, true));
        echo "',
    viewType: 'manager',

    getEntitiesUrl: '/group/%groupId/get-items',
    getEntitiesPositionsUrl: '/group/%groupId/get-positions',
    setEntitiesPositionsUrl: '/group/%groupId/set-positions',
    getEntitiesTypesUrl: '/group/%groupId/get-item-types',
    getEntitiesAvailableUrl: '/group/%groupId/get-available-items',
    getEntityFormUrl: '/group/%groupId/item-form/%bundle/%entityId',
    submitAddEntityFormUrl: '/group/%groupId/create-item/%bundle',
    addEntityUrl: '/group/%groupId/add-item',
    removeEntityUrl: '/group/%groupId/remove-item',
    addEntityLinkUrl: '/group/%groupId/add-link',
    updateEntityLinkUrl: '/group/%groupId/update-link',
    removeEntityLinkUrl: '/group/%groupId/remove-link',
    updateEntityMandatoryUrl: '/group/%groupId/update-mandatory',
    updateEntityMinScoreUrl: '/group/%groupId/update-min-score',
    updateEntitiesUrl: '/group/%groupId/update-entities',

    manageableEntities: ['ContentTypeCourse'],
    nextLink: '";
        // line 29
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["next_link"] ?? null), "html", null, true));
        echo "'
  };
</script>

<app-root class=\"d-block\">Loading app...</app-root>
";
    }

    public function getTemplateName()
    {
        return "profiles/opigno_lms/modules/opigno/opigno_group_manager/templates/opigno-group-manager.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 29,  59 => 9,  55 => 8,  47 => 3,  43 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "profiles/opigno_lms/modules/opigno/opigno_group_manager/templates/opigno-group-manager.html.twig", "/home/piyon/v8x/profiles/opigno_lms/modules/opigno/opigno_group_manager/templates/opigno-group-manager.html.twig");
    }
}
