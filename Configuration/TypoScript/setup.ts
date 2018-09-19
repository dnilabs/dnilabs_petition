
plugin.tx_dnilabspetition {
    view {
        templateRootPaths.0 = EXT:dnilabs/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_dnilabspetition.view.templateRootPath}
        partialRootPaths.0 = EXT:dnilabs/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_dnilabspetition.view.partialRootPath}
        layoutRootPaths.0 = EXT:dnilabs/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_dnilabspetition.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_dnilabspetition.persistence.storagePid}
        #recursive = 1
    }
    settings {
        fegroup = {$plugin.tx_dnilabspetition.settings.fegroup}
        success1 = {$plugin.tx_dnilabspetition.settings.success1}
        success2 = {$plugin.tx_dnilabspetition.settings.success2}
        baseurl = {$plugin.tx_dnilabspetition.settings.baseurl}
        emailfrom = {$plugin.tx_dnilabspetition.settings.emailfrom}
        emailsubject = {$plugin.tx_dnilabspetition.settings.emailsubject}
        limit = {$plugin.tx_dnilabspetition.settings.limit}
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

petitionpagebrowser = PAGE
petitionpagebrowser {
  typeNum = 666
  10 < tt_content.list.20.dnilabspetition_petition
  config {
   disableAllHeaderCode = 1
   additionalHeaders = Content-type:text/html
   xhtml_cleaning = 0
   admPanel = 0
   debug = 0
   no_cache = 1
  }
}

