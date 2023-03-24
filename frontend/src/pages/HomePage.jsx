import { Col, message, Row } from "antd";
import React, { useEffect, useState } from "react";
import CouponCard from "../components/CouponCard";
import Loading from "../components/Loading";
import MainLayout from "../components/MainLayout";
import { couponService } from "../services/coupon.service";

const HomePage = () => {
  const [list, setList] = useState([]);
  const [loading, setLoading] = useState(false);
  const [messageApi, contextHolder] = message.useMessage();

  const fetchCoupons = async () => {
    try {
      setLoading(true);
      const response = await couponService.list();
      setList(response.list);
    } catch (error) {
      messageApi.open({
        type: "error",
        content: error.message || "Something went wrong!",
      });
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchCoupons();
  }, []);

  const handleCouponHidden = (id) => {
    setList(list.filter((item) => item.id_coupon != id));

    messageApi.open({
      type: "success",
      content: "Coupon hidden!",
    });
  };

  return (
    <>
      {contextHolder}
      <MainLayout>
        {loading && <Loading />}
        {list && (
          <Row
            gutter={[
              { xs: 8, sm: 16, md: 24, lg: 32 },
              { xs: 8, sm: 16, md: 24, lg: 32 },
            ]}
          >
            {list
              // .filter((item) => item.coupon_type == "cashback")
              .map((item) => (
                <Col key={item.id_coupon} lg={{ span: 6 }} md={{ span: 8 }}>
                  <CouponCard item={item} onCouponHidden={handleCouponHidden} />
                </Col>
              ))}
          </Row>
        )}
      </MainLayout>
    </>
  );
};

export default HomePage;
