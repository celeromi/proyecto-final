# Faltantes
> Presupuesto: Revisar y que cree bien cada presupuesto con su detalle
> Presupuesto: Revisar la edición del presupuesto (aunque no deberían modificarse quizas solo cambiar el estado)
> Presupuesto: Comprobar que oculte bien
> Presupuesto: Comprobar que elimine bien
> Detalle del Presupuesto: ERROR - Si no colocaste bien un producto falla
> Detalle del Presupuesto: ERROR - No guarda correctamente el detalle
> Vistas: merge con cele

# MEJORAS

> Fallas en el Detalle del presupuesto
* Podría agregarse un atributo nuevo que identifique si se uso precio mayorista o minorista optimizando el codifo
* Clases a la cuales habia que modificar:
* models/presupuestoDetalle → atributo, guetter y setter
* models/presupuestoDetalleDAO → interracciones con las tablas
* controllers/presupuestos → lógica del controlador en la creación
* views/presupuestos/show → vista detallada

> Sistema de Validadores
* revisar que los datos que toman coniciden con los correspondeintes y testear
 
> Sistema de Errores/mesnajes
* Se puede mejorar para que muestre cada error particularmente