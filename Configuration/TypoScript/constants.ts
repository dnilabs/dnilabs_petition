
plugin.tx_dnilabspetition {
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
    settings {
        # cat=plugin.tx_dnilabspetition_petition//b; type=string; label=Frontend Usergroup ID
        fegroup = 1
        # cat=plugin.tx_dnilabspetition_petition//c; type=string; label=Success Page 1 PID
        success1 =
        # cat=plugin.tx_dnilabspetition_petition//d; type=string; label=Success Page 2 PID (activation)
        success2 =
        # cat=plugin.tx_dnilabspetition_petition//e; type=string; label=Base URL (https://www.dnilabs.com/)
        baseurl =
        # cat=plugin.tx_dnilabspetition_petition//e; type=string; label=Email From (Sender)
        emailfrom =
        # cat=plugin.tx_dnilabspetition_petition//e; type=string; label=Email Subject
        emailsubject =
    }
}
