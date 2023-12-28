<?xml version="1.0" encoding="utf-8"?>
  <jnlp spec="1.0+" codebase="http://www.norgei3d.no/webstart/VirtualGlobe-2019-04-12">    <information>
      <title>Virtual Globe.</title>
      <vendor>Norkart</vendor>
      <homepage href="../.."/>
      <description>The Virtual Globe</description>
      <description kind="short">The Virtual Globe</description>
      <offline-allowed/>
    </information>
    <update check="always" policy="always"/>
    <security>
      <all-permissions/>
    </security>
    <application-desc main-class="com.norkart.virtualglobe.gui.AV3DGlobeApplication">      <argument>-dataset=http://www.norgei3d.no/norge-globe.vgml</argument>      <argument>-viewpoint=7.988288466505503,58.16147777744699,42.723441457919726,153.46478547842688,-17.578134695463994</argument>    </application-desc>    <resources>
      <j2se version="1.6+" initial-heap-size="128M" max-heap-size="768M"/>

      <jar href="VirtualGlobe-jogl.jar"/>
      <jar href="VirtualGlobe-av3d.jar" main="true"/>      <extension name="jogl"    href="jsr-231-webstart-current/jogl.jnlp" />
      <extension name="odejava" href="ode/odejava.jnlp"/>
      <jar href="lib/log4j-1.2.15.jar"/>

      <jar href="lib/jdbm-1.0.jar"/>
      <jar href="lib/vecmath.jar"/>
      <jar href="lib/GeoPos.jar"/>
      <jar href="lib/aviatrix3d.jar"/>
      <jar href="icons.jar"/>

<!-- JMF -->

      <jar href="lib/jmf.jar" download="lazy"/>


<!-- Geo RSS -->

      <jar href="lib/GeoRSS.jar" download="lazy"/>
      <jar href="lib/jdom.jar" download="lazy"/>
      <jar href="lib/rome-1.0.jar" download="lazy"/>

<!-- The rest is for Xj3D -->

      <jar href="lib/dis-enums.jar" download="lazy"/>
      <jar href="lib/fastinfoset_1.2.9.jar" download="lazy"/>
      <jar href="lib/geoapi-nogenerics-2.1.0.jar" download="lazy"/>
      <jar href="lib/gnu-regexp-1.0.8.jar" download="lazy"/>
      <jar href="lib/gt2-main-2.4.4.jar" download="lazy"/>
      <jar href="lib/gt2-metadata-2.4.4.jar" download="lazy"/>
      <jar href="lib/gt2-referencing-2.4.4.jar" download="lazy"/>
      <jar href="lib/httpclient.jar" download="lazy"/>
      <jar href="lib/imageloader_1.1.0.jar" download="lazy"/>
      <jar href="lib/j3d-org-elumens.jar" download="lazy"/>
      <jar href="lib/j3d-org-geom-core.jar" download="lazy"/>
      <jar href="lib/j3d-org-geom-hanim.jar" download="lazy"/>
      <jar href="lib/j3d-org-geom-particle.jar" download="lazy"/>
      <jar href="lib/j3d-org-geom-spring.jar" download="lazy"/>
      <jar href="lib/j3d-org-geom-terrain.jar" download="lazy"/>
      <jar href="lib/j3d-org-inputdevice.jar" download="lazy"/>
      <jar href="lib/j3d-org-loader-3ds.jar" download="lazy"/>
      <jar href="lib/j3d-org-loader-core.jar" download="lazy"/>
      <jar href="lib/j3d-org-loader-dem.jar" download="lazy"/>
      <jar href="lib/j3d-org-loader-stl.jar" download="lazy"/>
      <jar href="lib/j3d-org-loader-vterrain.jar" download="lazy"/>
      <jar href="lib/j3d-org-navigation.jar" download="lazy"/>
      <jar href="lib/j3d-org-opengl-swt.jar" download="lazy"/>
      <jar href="lib/j3d-org-texture.jar" download="lazy"/>
      <jar href="lib/j3d-org-util.jar" download="lazy"/>
      <jar href="lib/jaxb-api.jar" download="lazy"/>
      <jar href="lib/jgeom-core.jar" download="lazy"/>
      <jar href="lib/jhall.jar" download="lazy"/>
      <jar href="lib/js.jar" download="lazy"/>
      <jar href="lib/jsr108-0.01.jar" download="lazy"/>
      <jar href="lib/jutils.jar" download="lazy"/>
      <jar href="lib/open-dis.jar" download="lazy"/>
      <jar href="lib/smack.jar" download="lazy"/>
      <jar href="lib/smackx.jar" download="lazy"/>
      <jar href="lib/uri.jar" download="lazy"/>
      <jar href="lib/vlc_uri.jar" download="lazy"/>
      <jar href="lib/xj3d-common_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-config_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-core_2.0.0.jar" download="lazy"/>
<!--      <jar href="lib/xj3d-device_2.0.0.jar" download="lazy"/> -->
      <jar href="lib/xj3d-eai_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-ecmascript_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-external-sai_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-external-sai-concrete_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-images_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-interchange-loader-av3d_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-java-sai_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-java-sai-concrete_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-jaxp_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-jsai_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-net_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-norender_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-ogl_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-parser_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-render_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-runtime_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-sai_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-sai-concrete_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-sav_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-script-base_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-xml_2.0.0.jar" download="lazy"/>
      <jar href="lib/xj3d-xml-util_2.0.0.jar" download="lazy"/>


<!-- Properties -->

      <property name="sun.java2d.noddraw" value="true"/>
      <property name="jnlp.packEnabled" value="true"/>
<!--
      <property name="java.net.preferIPv4Stack" value="true"/>	
      <property name="org.web3d.vrml.renderer.common.nodes.shape.useMipMaps" value="true"/>
      <property name="opengl.1thread" value="true"/>
-->
    </resources>
  </jnlp>
