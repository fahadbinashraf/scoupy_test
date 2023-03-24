import { Card, Col, ConfigProvider, Layout, Row } from "antd";
import React from "react";
import CouponCard from "./components/CouponCard";
import list from "./dummy_data";
const { Meta } = Card;
const App = () => {
  const { Header, Content } = Layout;
  return (
    <ConfigProvider
      theme={{
        token: {
          colorPrimary: "#f97f00",
        },
      }}
    >
      <Layout className="layout">
        <Header>
          <div className="logo">
            <img src="/scoupy-logo.svg" width={80} />
          </div>
        </Header>
        <Content style={{ padding: "0 50px" }}>
          <div className="site-layout-content">
            <Row
              gutter={[
                { xs: 8, sm: 16, md: 24, lg: 32 },
                { xs: 8, sm: 16, md: 24, lg: 32 },
              ]}
            >
              {list
                .filter((item) => item.coupon_type == "cashback")
                .map((item) => (
                  <Col lg={{ span: 6 }} md={{ span: 8 }}>
                    <CouponCard item={item} />
                  </Col>
                ))}
            </Row>
          </div>
        </Content>
      </Layout>
    </ConfigProvider>
  );
};

export default App;
