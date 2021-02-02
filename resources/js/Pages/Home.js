import React, {useState, useCallback, useEffect} from 'react'
import AppLayout from "../Shared/AppLayout"
import {Inertia} from '@inertiajs/inertia'
import enTranslations from '@shopify/polaris/locales/en.json'
import {AppProvider,
    Button,
    Page,
    Layout,
    FormLayout,
    Form,
    Checkbox,
    Card,
    Frame,
    TopBar,
    FooterHelp,
    Link,
    ChoiceList,
} from '@shopify/polaris';
import { TitleBar, Toast } from "@shopify/app-bridge-react";

function Home(settings) {

    const [disablerightclick, setDisableRightClick] = useState(settings.app_settings[0].disable_right_click ? true : false);
    const [disablef12, setDisableF12] = useState(settings.app_settings[0].disable_f12 ? true : false);
    const [disablecopy, setDisableCopy] = useState(settings.app_settings[0].disable_copy ? true : false);
    const [disablectrlshifti, setDisableCtrlShiftI] = useState(settings.app_settings[0].disable_ctrl_shift_i ? true : false);
    const [disablectrlanykey, setDisableCtrlAnykey] = useState(settings.app_settings[0].disable_ctrl_anykey ? true : false);
    const [disableselection, setDisableSelection] = useState(settings.app_settings[0].disable_text_image_selection ? true : false);

    const [active, setActive] = useState(false);
    const toggleActive = useCallback(() => setActive((active) => !active), []);
    const toastMarkup = active ? (
        <Toast content="App Setting Updated" onDismiss={toggleActive} />
    ) : null;
    //For Display Messaging function
    function handledisablerightclick(e){
        setDisableRightClick(e);
        console.log(e);
        const formData = new FormData();
        formData.append('disable_right_click', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handledisablef12(e){
        setDisableF12(e);
        console.log(e);
        const formData = new FormData();
        formData.append('disable_f12', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handledisablecopy(e){
        setDisableCopy(e);
        console.log(e);
        const formData = new FormData();
        formData.append('disable_copy', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handledisablectrlshifti(e){
        setDisableCtrlShiftI(e);
        console.log(e);
        const formData = new FormData();
        formData.append('disable_ctrl_shift_i', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handledisablectrlanykey(e){
        setDisableCtrlAnykey(e);
        console.log(e);
        const formData = new FormData();
        formData.append('disable_ctrl_anykey', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handledisableselection(e){
        setDisableSelection(e);
        console.log(e);
        const formData = new FormData();
        formData.append('disable_text_image_selection', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    //Top Bar
    const theme = {
      colors: {
        topBar: {
          background: '#fff',
          backgroundLighter: '#F4F6F8',
          backgroundDarker: '#DFE3E8',
          border: '#C4CDD5',
          color: '#212B36',
          minHeight: '10vh',
        },
      },
      logo: {
        width: 124,
        topBarSource:
          'https://www.authorized.by/wp-content/uploads/2020/04/abtsg-logo-header-english-blue.svg',
        url: '#',
        accessibilityLabel: 'Disable Right Click',
      },
    };

    const topBarMarkup = (
      <TopBar/>
    );

    return (
        <AppLayout>
        <div style={{height: '250px'}}>
            <AppProvider features={{newDesignLanguage: true}}
            theme={theme}
            i18n={{
            Polaris: {
                Avatar: {
                    label: 'Avatar',
                    labelWithInitials: 'Avatar with initials {initials}',
                },
                Frame: {skipToContent: 'Skip to content'},
            },
            }}>
                <Frame topBar={topBarMarkup} />
                <Page  primaryAction={{ disabled: true }} fullWidth={true} separator>
                    <Layout>
                        <Layout.AnnotatedSection title="authorized.by App Settings" description="The authorized.by® platform enables brands and manufacturers to authorize online business partners who can be trusted by using a realtime seal valid across the board.">
                            <Card title="authorized.by App Settings" sectioned>
                                <Form>
                                    <FormLayout>
                                        <Checkbox
                                            label="Enable Header Seal"
                                            checked={disablerightclick}
                                            onChange={handledisablerightclick}
                                            onClick={toggleActive}
                                        />
                                        <Checkbox
                                            label="Enable Footer Seal"
                                            checked={disablef12}
                                            onChange={handledisablef12}
                                            onClick={toggleActive}
                                        />
                                        <Checkbox
                                            label="Enable Content Seal"
                                            checked={disablecopy}
                                            onChange={handledisablecopy}
                                            onClick={toggleActive}
                                        />
                                    </FormLayout>
                                </Form>
                            </Card>
                        </Layout.AnnotatedSection>
                    </Layout>
                    <FooterHelp>
                        Learn more about{' '}
                        <Link url="https://www.authorized.by/">
                            <strong>authorized.by®</strong>
                        </Link>
                    </FooterHelp>
                    {toastMarkup}
                </Page>
            </AppProvider>
        </div>
        </AppLayout>
    )
}

export default Home

