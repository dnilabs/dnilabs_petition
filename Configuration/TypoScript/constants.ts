
plugin.tx_dnilabspetition_petition {
    view {
        # cat=plugin.tx_dnilabspetition_petition/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:dnilabs_petition/Resources/Private/Templates/
        # cat=plugin.tx_dnilabspetition_petition/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:dnilabs_petition/Resources/Private/Partials/
        # cat=plugin.tx_dnilabspetition_petition/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:dnilabs_petition/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_dnilabspetition_petition//a; type=string; label=Default storage PID
        storagePid =
    }
}
