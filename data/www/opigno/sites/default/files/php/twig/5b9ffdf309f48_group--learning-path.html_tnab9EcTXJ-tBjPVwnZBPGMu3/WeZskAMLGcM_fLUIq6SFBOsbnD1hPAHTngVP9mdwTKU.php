<?php

/* profiles/opigno_lms/modules/opigno/opigno_learning_path/templates/group--learning-path.html.twig */
class __TwigTemplate_d9dfad0026bf0849d5002e0592921bd8edb26ef768119ab79bc675ce3a28963c extends Twig_Template
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
        $tags = array("if" => 45);
        $filters = array("t" => 57, "without" => 82);
        $functions = array("opigno_catalog_is_member" => 52, "get_progress" => 53, "opigno_catalog_get_default_image" => 63, "get_join_group_link" => 75, "get_start_link" => 85, "get_training_content" => 88);

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('if'),
                array('t', 'without'),
                array('opigno_catalog_is_member', 'get_progress', 'opigno_catalog_get_default_image', 'get_join_group_link', 'get_start_link', 'get_training_content')
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

        // line 42
        echo "<div";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["attributes"] ?? null), "addclass", array(0 => "group-opigno-course"), "method"), "html", null, true));
        echo ">

  ";
        // line 44
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["title_prefix"] ?? null), "html", null, true));
        echo "
  ";
        // line 45
        if ( !($context["page"] ?? null)) {
            // line 46
            echo "    <h2";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["title_attributes"] ?? null), "html", null, true));
            echo ">
      <a href=\"";
            // line 47
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["url"] ?? null), "html", null, true));
            echo "\" rel=\"bookmark\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true));
            echo "</a>
    </h2>
  ";
        }
        // line 50
        echo "  ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["title_suffix"] ?? null), "html", null, true));
        echo "
  <div class=\"row\">
    ";
        // line 52
        if ($this->env->getExtension('Drupal\opigno_catalog\TwigExtension\DefaultTwigExtension')->is_member($this->getAttribute(($context["group"] ?? null), "id", array(), "method"))) {
            // line 53
            echo "      ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\opigno_learning_path\TwigExtension\DefaultTwigExtension')->get_progress(), "html", null, true));
            echo "
    ";
        }
        // line 55
        echo "    <div class=\"col-md-4\">
      <section>
        <h2 class=\"h4 bg-primary color-white text-uppercase mb-0 px-3 py-2\">";
        // line 57
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Informations")));
        echo "</h2>
        <div class=\"content bg-light py-2 pr-3\">
          <div class=\"lp-image\">
            ";
        // line 60
        if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_learning_path_image", array()), 0, array(), "array")) {
            // line 61
            echo "              ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["content"] ?? null), "field_learning_path_image", array()), "html", null, true));
            echo "
            ";
        } else {
            // line 63
            echo "              ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\opigno_catalog\TwigExtension\DefaultTwigExtension')->get_default_image("learning_path"), "html", null, true));
            echo "
            ";
        }
        // line 65
        echo "          </div>
          <div class=\"duration d-flex px-2 py-2 bg-white mt-2\">
            <div class=\"label\">";
        // line 67
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Length")));
        echo "</div>
            <div class=\"value text-right ml-auto\">";
        // line 68
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["content"] ?? null), "field_learning_path_duration", array()), "html", null, true));
        echo "</div>
          </div>
          <div class=\"category d-flex px-2 py-2 bg-white mt-2\">
            <div class=\"label\">";
        // line 71
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Subject")));
        echo "</div>
            <div class=\"value text-right ml-auto\">";
        // line 72
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_learning_path_category", array()), 0, array()), "#title", array(), "array"), "html", null, true));
        echo "</div>
          </div>
        </div>
        ";
        // line 75
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\opigno_learning_path\TwigExtension\DefaultTwigExtension')->get_join_group_link(null, null, array("class" => array(0 => "opigno-quiz-app-course-button", 1 => "bg-success", 2 => "color-white", 3 => "d-block", 4 => "px-2", 5 => "py-2", 6 => "text-center", 7 => "text-uppercase", 8 => "join-link"))), "html", null, true));
        echo "
      </section>
    </div>
    <div id=\"group-content\" ";
        // line 78
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["content_attributes"] ?? null), "addClass", array(0 => "col-md-8"), "method"), "html", null, true));
        echo ">
      <h2 class=\"h4 bg-primary text-uppercase color-white mb-0 px-3 py-2\">";
        // line 79
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("About this course")));
        echo "</h2>
      <div class=\"content bg-light px-2 pt-2\">
        <div class=\"bg-white px-3 py-3\">
          ";
        // line 82
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_without(($context["content"] ?? null), "field_learning_path_image", "field_learning_path_duration", "field_learning_path_category"), "html", null, true));
        echo "
        </div>
      </div>
      ";
        // line 85
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\opigno_learning_path\TwigExtension\DefaultTwigExtension')->get_start_link(null, array("class" => array(0 => "opigno-quiz-app-course-button", 1 => "bg-success", 2 => "color-white", 3 => "d-block", 4 => "px-2", 5 => "py-2", 6 => "text-center", 7 => "text-uppercase"))), "html", null, true));
        echo "
    </div>
    <div class=\"col-12\">
      ";
        // line 88
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\opigno_learning_path\TwigExtension\DefaultTwigExtension')->get_training_content(), "html", null, true));
        echo "
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "profiles/opigno_lms/modules/opigno/opigno_learning_path/templates/group--learning-path.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  158 => 88,  152 => 85,  146 => 82,  140 => 79,  136 => 78,  130 => 75,  124 => 72,  120 => 71,  114 => 68,  110 => 67,  106 => 65,  100 => 63,  94 => 61,  92 => 60,  86 => 57,  82 => 55,  76 => 53,  74 => 52,  68 => 50,  60 => 47,  55 => 46,  53 => 45,  49 => 44,  43 => 42,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "profiles/opigno_lms/modules/opigno/opigno_learning_path/templates/group--learning-path.html.twig", "/home/piyon/v8x/profiles/opigno_lms/modules/opigno/opigno_learning_path/templates/group--learning-path.html.twig");
    }
}
