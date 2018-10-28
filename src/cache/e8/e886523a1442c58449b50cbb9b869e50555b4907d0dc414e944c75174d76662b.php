<?php

/* user/list.twig */
class __TwigTemplate_82d976604615c030b60a37d0a336430c7bbed37156a636a0c8b5c6cb335140be extends Twig_Template
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
        // line 1
        echo "<html>
\t<head>
\t\t<title>
\t\t\t用户列表
\t\t</title>
\t\t<style type=\"text/css\">
\t\t\tul,li{list-style: none;}
\t\t</style>
\t</head>
\t<body>
\t\t<ul>
\t\t\t";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 13
            echo "\t\t\t\t
\t\t\t
\t\t\t<li><label>用户名：";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", array()), "html", null, true);
            echo "</label><label>年龄：";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "age", array()), "html", null, true);
            echo "</label></li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "\t\t</ul>

\t</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "user/list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 17,  40 => 15,  36 => 13,  32 => 12,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<html>
\t<head>
\t\t<title>
\t\t\t用户列表
\t\t</title>
\t\t<style type=\"text/css\">
\t\t\tul,li{list-style: none;}
\t\t</style>
\t</head>
\t<body>
\t\t<ul>
\t\t\t{% for item in users %}
\t\t\t\t
\t\t\t
\t\t\t<li><label>用户名：{{item.name}}</label><label>年龄：{{item.age}}</label></li>
\t\t{% endfor %}
\t\t</ul>

\t</body>
</html>
", "user/list.twig", "D:\\project\\phproute\\src\\Views\\user\\list.twig");
    }
}
