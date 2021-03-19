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
    TextField,
    ChoiceList,
} from '@shopify/polaris';
import { TitleBar, Toast } from "@shopify/app-bridge-react";

function Home(settings) {

    const [disableheaderseal, setHeaderseal] = useState(settings.app_settings[0].authorize_header ? true : false);
    const [disablefooterseal, setFooterseal] = useState(settings.app_settings[0].authorize_footer ? true : false);
    const [disablecontentseal, setContentseal] = useState(settings.app_settings[0].authorize_content ? true : false);

    const [headersealstyling, setHeadersealstyling] = useState(settings.app_settings[0].hs_top_setting ? settings.app_settings[0].hs_top_setting : false);
    const [headersealstylingv, setHeadersealstylingv] = useState(settings.app_settings[0].hs_left_setting ? settings.app_settings[0].hs_left_setting : false);

    const [footersealstyling, setFootersealstyling] = useState(settings.app_settings[0].fs_top_setting ? settings.app_settings[0].fs_top_setting : false);
    const [footersealstylingv, setFootersealstylingv] = useState(settings.app_settings[0].fs_left_setting ? settings.app_settings[0].fs_left_setting : false);

    const [active, setActive] = useState(false);
    const toggleActive = useCallback(() => setActive((active) => !active), []);
    const toastMarkup = active ? (
        <Toast content="App Setting Updated" onDismiss={toggleActive} />
    ) : null;
    //For Display Messaging function
    function handleheaderseal(e){
        setHeaderseal(e);
        console.log(e);
        const formData = new FormData();
        formData.append('authorize_header', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handlefooterseal(e){
        setFooterseal(e);
        console.log(e);
        const formData = new FormData();
        formData.append('authorize_footer', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handlecontentseal(e){
        setContentseal(e);
        console.log(e);
        const formData = new FormData();
        formData.append('authorize_content', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handleHeaderStyling(e){
        setHeadersealstyling(e);
        console.log(e);
        const formData = new FormData();
        formData.append('hs_top_setting', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handleHeaderStylingv(e){
        setHeadersealstylingv(e);
        console.log(e);
        const formData = new FormData();
        formData.append('hs_left_setting', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handleFooterStyling(e){
        setFootersealstyling(e);
        console.log(e);
        const formData = new FormData();
        formData.append('fs_top_setting', e);
        Inertia.post('/disable-settings', formData);
        toggleActive();
    }

    function handleFooterStylingv(e){
        setFootersealstylingv(e);
        console.log(e);
        const formData = new FormData();
        formData.append('fs_left_setting', e);
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
                                            checked={disableheaderseal}
                                            onChange={handleheaderseal}
                                            onClick={toggleActive}
                                        />
                                        <Checkbox
                                            label="Enable Footer Seal"
                                            checked={disablefooterseal}
                                            onChange={handlefooterseal}
                                            onClick={toggleActive}
                                        />
                                        <Checkbox
                                            label="Enable Content Seal"
                                            checked={disablecontentseal}
                                            onChange={handlecontentseal}
                                            onClick={toggleActive}
                                        />
                                    </FormLayout>
                                </Form>
                            </Card>
                        </Layout.AnnotatedSection>
                        <Layout.AnnotatedSection title="authorized.by Header Seal Position" description="Set the position of the header seal in the website">
                            <Card title="authorized.by Header Seal Position" sectioned>
                                <Form>
                                    <FormLayout>
                                    <TextField
                                        value={headersealstyling}
                                        onChange={handleHeaderStyling}
                                        label="Adjust Vertically"
                                        type="text"
                                        max="500"
                                        helpText={
                                            <span>
                                                You can add both negative and positive values e.g: 10 / -10
                                                Please use px or % with number to adjust the seal
                                            </span>
                                        }
                                    />
                                    <TextField
                                        value={headersealstylingv}
                                        onChange={handleHeaderStylingv}
                                        label="Adjust Horizantally"
                                        type="text"
                                        max="100"
                                        helpText={
                                            <span>
                                                You can add both negative and positive values 10 / -10
                                                Please use px or % with number to adjust the seal
                                            </span>
                                        }
                                    />
                                    </FormLayout>
                                </Form>
                            </Card>
                        </Layout.AnnotatedSection>
                        <Layout.AnnotatedSection title="authorized.by Footer Seal Position" description="Set the position of the footer seal in the website">
                            <Card title="authorized.by Footer Seal Position" sectioned>
                                <Form>
                                    <FormLayout>
                                    <TextField
                                        value={footersealstyling}
                                        onChange={handleFooterStyling}
                                        label="Adjust Vertically"
                                        type="text"
                                        max="100"
                                        helpText={
                                            <span>
                                                You can add both negative and positive values e.g: 10 / -10
                                                Please use px or % with number to adjust the seal
                                            </span>
                                        }
                                    />
                                    <TextField
                                        value={footersealstylingv}
                                        onChange={handleFooterStylingv}
                                        label="Adjust Horizantally"
                                        type="text"
                                        max="100"
                                        helpText={
                                            <span>
                                                You can add both negative and positive values e.g: 10 / -10
                                                Please use px or % with number to adjust the seal
                                            </span>
                                        }
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

